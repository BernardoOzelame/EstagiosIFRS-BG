<?php

namespace Model;

use Model\VO\CursoVO;
use Util\Database;

final class CursoModel extends Model {

    public function selectAll($vo = null) {
        $db = new Database();
        $data = $db->select("SELECT * FROM cursos ORDER BY id ASC");

        $array = [];

        foreach($data as $row){
            $vo = new CursoVO($row["id"], $row["nome"]);
            array_push($array, $vo);
        }

        return $array;
    }

    public function selectOne($vo = null) {
        $db = new Database();

        $query = "SELECT * FROM cursos where id = :id";
        $binds = [":id" => $vo->getId()]; 
        $data = $db->select($query, $binds);

        if(count($data) == 0 ) {
            return null;
        }

        return new CursoVO($data[0]["id"], $data[0]["nome"]);
    }

    public function insert($vo) {
        $db = new Database();
        $query = "INSERT INTO cursos (nome) VALUES (:nome)";
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
        $query = "UPDATE cursos SET nome = :nome WHERE id = :id";
        $binds = [":nome" => $vo->getNome(), ":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

    public function delete($vo) {
        $db = new Database();
        $query = "DELETE FROM cursos WHERE id = :id";
        $binds = [":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

}