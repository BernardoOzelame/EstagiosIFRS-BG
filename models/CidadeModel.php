<?php

namespace Model;

use Model\VO\CidadeVO;
use Util\Database;

final class CidadeModel extends Model {

    public function selectAll($vo = null) {
        $db = new Database();
        $data = $db->select("SELECT * FROM cidades ORDER BY id ASC");

        $array = [];

        foreach($data as $row){
            $vo = new CidadeVO($row["id"], $row["nome"], $row["uf"]);
            array_push($array, $vo);
        }

        return $array;
    }

    public function selectOne($vo = null) {
        $db = new Database();

        $query = "SELECT * FROM cidades where id = :id";
        $binds = [":id" => $vo->getId()]; 
        $data = $db->select($query, $binds);

        if(count($data) == 0 ) {
            return null;
        }

        return new CidadeVO($data[0]["id"], $data[0]["nome"], $data[0]["uf"]);
    }

    public function insert($vo) {
        $db = new Database();
        $query = "INSERT INTO cidades (nome, uf) VALUES (:nome, :uf)";
        $binds = [":nome" => $vo->getNome(), ":uf" => $vo->getUf()];

        $success = $db->execute($query, $binds);

        if($success) {
            return $db->getLastInsertedId();
        } else {
            return null;
        }
    }

    public function update($vo) {   
        $db = new Database();
        $query = "UPDATE cidades SET nome = :nome, uf = :uf WHERE id = :id";
        $binds = [":nome" => $vo->getNome(), ":uf" => $vo->getUf(), ":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

    public function delete($vo) {
        $db = new Database();
        $query = "DELETE FROM cidades WHERE id = :id";
        $binds = [":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

}