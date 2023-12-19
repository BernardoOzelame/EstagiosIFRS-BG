<?php

namespace Model;

use Model\VO\EmpresaVO;
use Util\Database;

final class EmpresaModel extends Model {

    public function selectAll($vo = null) {
        $db = new Database();
        $data = $db->select("SELECT empresas.*, cidades.nome as cidade, areas.nome as area FROM empresas JOIN cidades ON empresas.cidades_id = cidades.id JOIN areas ON empresas.areas_id = areas.id ORDER BY id ASC");

        $array = [];

        foreach($data as $row){
            $vo = new EmpresaVO($row["id"], $row["cnpj"], $row["numConvenio"], $row["nome"], $row["endereco"], $row["telefoneCelular"], $row["email"], $row["areas_id"], $row["cidades_id"], $row["cidade"], $row["area"]);
            array_push($array, $vo);
        }

        return $array;
    }

    public function selectOne($vo = null) { 
        $db = new Database();

        $query = "SELECT * FROM empresas where id = :id";
        $binds = [":id" => $vo->getId()]; 
        $data = $db->select($query, $binds);

        if(count($data) == 0 ) {
            return null;
        }

        return new EmpresaVO($data[0]["id"], $data[0]["cnpj"], $data[0]["numConvenio"], $data[0]["nome"], $data[0]["endereco"], $data[0]["telefoneCelular"], $data[0]["email"], $data[0]["areas_id"], $data[0]["cidades_id"]); 
    }

    public function insert($vo) {
        $db = new Database();
        $query = "INSERT INTO empresas (cnpj, numConvenio, nome, endereco, telefoneCelular, email, areas_id, cidades_id) VALUES (:cnpj, :numConvenio, :nome, :endereco, :telefoneCelular, :email, :areas_id, :cidades_id)";
        $binds = [":cnpj" => $vo->getCnpj(), ":numConvenio" => $vo->getNumConvenio(), ":nome" => $vo->getNome(), ":endereco" => $vo->getEndereco(), ":telefoneCelular" => $vo->getTelefoneCelular(), ":email" => $vo->getEmail(), ":areas_id" => $vo->getAreas_id(), ":cidades_id" => $vo->getCidades_id()];

        $success = $db->execute($query, $binds);

        if($success) {
            return $db->getLastInsertedId();
        } else {
            return null;
        }
    }

    public function update($vo) {   
        $db = new Database();
        $query = "UPDATE empresas SET cnpj = :cnpj, numConvenio = :numConvenio, nome = :nome, endereco = :endereco, telefoneCelular = :telefoneCelular, email = :email, areas_id = :areas_id, cidades_id = :cidades_id WHERE id = :id";
        $binds = [":cnpj" => $vo->getCnpj(), ":numConvenio" => $vo->getNumConvenio(), ":nome" => $vo->getNome(), ":endereco" => $vo->getEndereco(), ":telefoneCelular" => $vo->getTelefoneCelular(), ":email" => $vo->getEmail(), ":areas_id" => $vo->getAreas_id(), ":cidades_id" => $vo->getCidades_id(), ":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

    public function delete($vo) {
        $db = new Database(); 
        $query = "DELETE FROM empresas WHERE id = :id";
        $binds = [":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

}