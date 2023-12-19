<?php

namespace Model;

use Model\VO\AlunoVO;
use Util\Database;

final class AlunoModel extends Model {

    public function selectAll($vo = null) {
        $db = new Database();
        $data = $db->select("SELECT alunos.*, cidades.nome as cidade, cursos.nome as curso FROM alunos JOIN cidades ON alunos.cidades_id = cidades.id JOIN cursos ON alunos.curso_id = cursos.id ORDER BY id ASC");

        $array = [];

        foreach($data as $row){
            $vo = new AlunoVO($row["id"], $row["matricula"], $row["nome"], $row["email"], $row["cpf"], $row["rg"], $row["endereco"], $row["telefoneCelular"], $row["anoEstagio"], $row["finalizou2Ano"], $row["cidades_id"], $row["curso_id"], $row["cidade"], $row["curso"]);
            array_push($array, $vo);
        }

        return $array;
    }

    public function selectOne($vo = null) { 
        $db = new Database();

        $query = "SELECT * FROM alunos where id = :id";
        $binds = [":id" => $vo->getId()]; 
        $data = $db->select($query, $binds);

        if(count($data) == 0 ) {
            return null;
        }

        return new AlunoVO($data[0]["id"], $data[0]["matricula"], $data[0]["nome"], $data[0]["email"], $data[0]["cpf"], $data[0]["rg"], $data[0]["endereco"], $data[0]["telefoneCelular"], $data[0]["anoEstagio"], $data[0]["finalizou2Ano"], $data[0]["cidades_id"], $data[0]["curso_id"]);
    }

    public function insert($vo) {
        $db = new Database();
        $query = "INSERT INTO alunos (matricula, nome, email, cpf, rg, endereco, telefoneCelular, anoEstagio, finalizou2Ano, cidades_id, curso_id) VALUES (:matricula, :nome, :email, :cpf, :rg, :endereco, :telefoneCelular, :anoEstagio, :finalizou2Ano, :cidades_id, :curso_id)";
        $binds = [":matricula" => $vo->getMatricula(), ":nome" => $vo->getNome(), ":email" => $vo->getEmail(), ":cpf" => $vo->getCpf(), ":rg" => $vo->getRg(), ":endereco" => $vo->getEndereco(), ":telefoneCelular" => $vo->getTelefoneCelular(), ":anoEstagio" => $vo->getAnoEstagio(), ":finalizou2Ano" => $vo->getFinalizou2Ano(), ":cidades_id" => $vo->getCidades_id(), ":curso_id" => $vo->getCursos_id()];

        $success = $db->execute($query, $binds);

        if($success) {
            return $db->getLastInsertedId();
        } else {
            return null;
        }
    }

    public function update($vo) {   
        $db = new Database();
        $query = "UPDATE alunos SET matricula = :matricula, nome = :nome, email = :email, cpf = :cpf, rg = :rg, endereco = :endereco, telefoneCelular = :telefoneCelular, anoEstagio = :anoEstagio, finalizou2Ano = :finalizou2Ano, cidades_id = :cidades_id, curso_id = :curso_id WHERE id = :id";
        $binds = [":matricula" => $vo->getMatricula(), ":nome" => $vo->getNome(), ":email" => $vo->getEmail(), ":cpf" => $vo->getCpf(), ":rg" => $vo->getRg(), ":endereco" => $vo->getEndereco(), ":telefoneCelular" => $vo->getTelefoneCelular(), ":anoEstagio" => $vo->getAnoEstagio(), ":finalizou2Ano" => $vo->getFinalizou2Ano(), ":cidades_id" => $vo->getCidades_id(), ":curso_id" => $vo->getCursos_id(), ":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

    public function delete($vo) {
        $db = new Database(); 
        $query = "DELETE FROM alunos WHERE id = :id";
        $binds = [
            ":id" => $vo->getId()
        ];

        return $db->execute($query, $binds);
    }

}