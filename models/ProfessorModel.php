<?php

namespace Model;

use Model\VO\ProfessorVO;
use Util\Database;

final class ProfessorModel extends Model {

    public function selectAll($vo = null) {
        $db = new Database();
        $data = $db->select("SELECT professores.*, areas.nome as area FROM professores JOIN areas ON professores.areas_id = areas.id ORDER BY id ASC");

        $array = [];

        foreach($data as $row){
            $vo = new ProfessorVO($row["id"], $row["siap"], $row["nome"], $row["email"], $row["areas_id"], $row["area"]);
            array_push($array, $vo);
        }

        return $array;
    }

    public function selectOne($vo = null) {
        $db = new Database();

        $query = "SELECT * FROM professores where id = :id";
        $binds = [":id" => $vo->getId()]; 
        $data = $db->select($query, $binds);

        if(count($data) == 0 ) {
            return null;
        }

        return new ProfessorVO($data[0]["id"], $data[0]["siap"], $data[0]["nome"], $data[0]["email"], $data[0]["areas_id"]);
    }

    public function insert($vo) {
        $db = new Database();
        $query = "INSERT INTO professores (siap, nome, email, areas_id) VALUES (:siap, :nome, :email, :areas_id)";
        $binds = [":siap" => $vo->getSiap(), ":nome" => $vo->getNome(), ":email" => $vo->getEmail(), ":areas_id" => $vo->getAreas_id()];

        $success = $db->execute($query, $binds);

        if($success) {
            return $db->getLastInsertedId();
        } else {
            return null;
        }
    }

    public function update($vo) {   
        $db = new Database();
        $query = "UPDATE professores SET siap = :siap, nome = :nome, email = :email, areas_id = :areas_id WHERE id = :id";
        $binds = [":siap" => $vo->getSiap(), ":nome" => $vo->getNome(), ":email" => $vo->getEmail(), ":areas_id" => $vo->getAreas_id(), ":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

    public function delete($vo) {
        $db = new Database(); 
        $query = "DELETE FROM professores WHERE id = :id";
        $binds = [ ":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

}