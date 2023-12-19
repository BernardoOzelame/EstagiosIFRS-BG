<?php

namespace Model;

use Model\VO\RepresentanteVO;
use Util\Database;

final class RepresentanteModel extends Model {

    public function selectAll($vo = null) {
        $db = new Database();
        $data = $db->select("SELECT representantes.*, empresas.nome as empresa FROM representantes JOIN empresas ON representantes.empresas_id = empresas.id ORDER BY id ASC");

        $array = [];

        foreach($data as $row){
            $vo = new RepresentanteVO($row["id"], $row["nome"], $row["funcao"], $row["cpf"], $row["rg"], $row["empresas_id"], $row["empresa"]);
            array_push($array, $vo);
        }

        return $array;
    }

    public function selectOne($vo = null) { 
        $db = new Database();

        $query = "SELECT * FROM representantes where id = :id";
        $binds = [":id" => $vo->getId()]; 
        $data = $db->select($query, $binds);

        if(count($data) == 0 ) {
            return null;
        }

        return new RepresentanteVO($data[0]["id"], $data[0]["nome"], $data[0]["funcao"], $data[0]["cpf"], $data[0]["rg"], $data[0]["empresas_id"]); 
    }

    public function insert($vo) {
        $db = new Database();
        $query = "INSERT INTO representantes (nome, funcao, cpf, rg, empresas_id) VALUES (:nome, :funcao, :cpf, :rg, :empresas_id)";
        $binds = [":nome" => $vo->getNome(), ":funcao" => $vo->getFuncao(), ":cpf" => $vo->getCpf(), ":rg" => $vo->getRg(), ":empresas_id" => $vo->getEmpresas_id()];

        $success = $db->execute($query, $binds);

        if($success) {
            return $db->getLastInsertedId();
        } else {
            return null;
        }
    }

    public function update($vo) {   
        $db = new Database();
        $query = "UPDATE representantes SET nome = :nome, funcao = :funcao, cpf = :cpf, rg = :rg, empresas_id = :empresas_id WHERE id = :id";
        $binds = [":nome" => $vo->getNome(), ":funcao" => $vo->getFuncao(), ":cpf" => $vo->getCpf(), ":rg" => $vo->getRg(), ":empresas_id" => $vo->getEmpresas_id(), ":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

    public function delete($vo) {
        $db = new Database(); 
        $query = "DELETE FROM representantes WHERE id = :id";
        $binds = [":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

}