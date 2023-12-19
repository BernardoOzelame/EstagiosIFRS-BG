<?php

namespace Model;

use Model\VO\SupervisorVO;
use Util\Database;

final class SupervisorModel extends Model {

    public function selectAll($vo = null) {
        $db = new Database();
        $data = $db->select("SELECT supervisores.*, empresas.nome as empresa FROM supervisores JOIN empresas ON supervisores.empresas_id = empresas.id ORDER BY id ASC");

        $array = [];

        foreach($data as $row){
            $vo = new SupervisorVO($row["id"], $row["nome"], $row["email"], $row["cargo"], $row["formacao"], $row["telefoneCelular"], $row["empresas_id"], $row["empresa"]);
            array_push($array, $vo);
        }

        return $array;
    }

    public function selectOne($vo = null) { 
        $db = new Database();

        $query = "SELECT * FROM supervisores where id = :id";
        $binds = [":id" => $vo->getId()]; 
        $data = $db->select($query, $binds);

        if(count($data) == 0 ) {
            return null;
        }

        return new SupervisorVO($data[0]["id"], $data[0]["nome"], $data[0]["email"], $data[0]["cargo"], $data[0]["formacao"], $data[0]["telefoneCelular"], $data[0]["empresas_id"]); 
    }

    public function insert($vo) {
        $db = new Database();
        $query = "INSERT INTO supervisores (nome, email, cargo, formacao, telefoneCelular, empresas_id) VALUES (:nome, :email, :cargo, :formacao, :telefoneCelular, :empresas_id)";
        $binds = [":nome" => $vo->getNome(), ":email" => $vo->getEmail(), ":cargo" => $vo->getCargo(), ":formacao" => $vo->getFormacao(), ":telefoneCelular" => $vo->getTelefoneCelular(), ":empresas_id" => $vo->getEmpresas_id()];

        $success = $db->execute($query, $binds);

        if($success) {
            return $db->getLastInsertedId();
        } else {
            return null;
        }
    }

    public function update($vo) {   
        $db = new Database();
        $query = "UPDATE supervisores SET nome = :nome, email = :email, cargo = :cargo, formacao = :formacao, telefoneCelular = :telefoneCelular, empresas_id = :empresas_id WHERE id = :id";
        $binds = [":nome" => $vo->getNome(), ":email" => $vo->getEmail(), ":cargo" => $vo->getCargo(), ":formacao" => $vo->getFormacao(), ":telefoneCelular" => $vo->getTelefoneCelular(), ":empresas_id" => $vo->getEmpresas_id(), ":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

    public function delete($vo) {
        $db = new Database(); 
        $query = "DELETE FROM supervisores WHERE id = :id";
        $binds = [":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

}