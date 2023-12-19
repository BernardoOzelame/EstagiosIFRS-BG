<?php

namespace Model;

use Model\VO\AreaVO;
use Util\Database;

final class AreaModel extends Model {

    public function selectAll($vo = null) {
        $db = new Database();
        $data = $db->select("SELECT * FROM areas ORDER BY id ASC");

        $array = [];

        foreach($data as $row){
            $vo = new AreaVO($row["id"], $row["nome"]);
            array_push($array, $vo);
        }

        return $array;
    }

    public function selectOne($vo = null) {
        $db = new Database();

        $query = "SELECT * FROM areas where id = :id";
        $binds = [":id" => $vo->getId()]; 
        $data = $db->select($query, $binds);

        if(count($data) == 0 ) {
            return null;
        }

        return new AreaVO($data[0]["id"], $data[0]["nome"]);
    }

    public function insert($vo) {
        $db = new Database();
        $query = "INSERT INTO areas (nome) VALUES (:nome)";
        $binds = [":nome" => $vo->getNome()];

        $success = $db->execute($query, $binds);

        if($success) {
            return $db->getLastInsertedId();
        } else {
            return null;
        }
    }

    public function update($vo) {   
        $db = new Database();
        $query = "UPDATE areas SET nome = :nome WHERE id = :id";
        $binds = [":nome" => $vo->getNome(), ":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

    public function delete($vo) {
        $db = new Database();
        $query = "DELETE FROM areas WHERE id = :id";
        $binds = [":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

}