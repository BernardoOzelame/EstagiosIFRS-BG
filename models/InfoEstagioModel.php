<?php

namespace Model;

use Model\VO\InfoEstagioVO;
use Util\Database;

final class InfoEstagioModel extends Model {

    public function selectAll($vo = null) {
        $db = new Database();
        $data = $db->select("SELECT infoestagios.*, supervisores.nome AS supervisor, cursos.nome AS curso, orientador.nome AS professorOrientador, coorientador.nome AS professorCoOrientador, empresas.nome AS empresa, alunos.nome AS aluno FROM infoestagios LEFT JOIN supervisores ON infoestagios.supervisores_id = supervisores.id JOIN cursos ON infoestagios.cursos_id = cursos.id LEFT JOIN professores AS orientador ON infoestagios.professorOrientador_id = orientador.id LEFT JOIN professores AS coorientador ON infoestagios.professorCoOrientador_id = coorientador.id LEFT JOIN empresas ON infoestagios.empresas_id = empresas.id LEFT JOIN alunos ON infoestagios.alunos_id = alunos.id ORDER BY id ASC");

        $array = [];

        foreach($data as $row){
            $vo = new InfoEstagioVO($row["id"], $row["cargaHoraria"], $row["inicio"], $row["termino"], $row["previsaoFim"], $row["situacao"], $row["supervisores_id"], $row["cursos_id"], $row["professorOrientador_id"], $row["professorCoOrientador_id"], $row["empresas_id"], $row["alunos_id"], $row["supervisor"], $row["curso"], $row["professorOrientador"], $row["professorCoOrientador"], $row["empresa"], $row["aluno"]);
            array_push($array, $vo);
        }

        return $array;
    }

    public function selectOne($vo = null) {
        $db = new Database();

        $query = "SELECT * FROM infoEstagios where id = :id";
        $binds = [":id" => $vo->getId()]; 
        $data = $db->select($query, $binds);

        if(count($data) == 0 ) {
            return null;
        }

        return new InfoEstagioVO($data[0]["id"], $data[0]["cargaHoraria"], $data[0]["inicio"], $data[0]["termino"], $data[0]["previsaoFim"], $data[0]["situacao"], $data[0]["supervisores_id"], $data[0]["cursos_id"], $data[0]["professorOrientador_id"], $data[0]["professorCoOrientador_id"], $data[0]["empresas_id"], $data[0]["alunos_id"]);
    }

    public function insert($vo) {
        $db = new Database();
        $query = "INSERT INTO infoEstagios (cargaHoraria, inicio, termino, previsaoFim, situacao, supervisores_id, cursos_id, professorOrientador_id, professorCoOrientador_id, empresas_id, alunos_id) VALUES (:cargaHoraria, :inicio, :termino, :previsaoFim, :situacao, :supervisores_id, :cursos_id, :professorOrientador_id, :professorCoOrientador_id, :empresas_id, :alunos_id)";
        $binds = [":cargaHoraria" => $vo->getCargaHoraria(), ":inicio" => $vo->getInicio(), ":termino" => $vo->getTermino(), ":previsaoFim" => $vo->getPrevisaoFim(), ":situacao" => $vo->getSituacao(), ":supervisores_id" => $vo->getSupervisores_id(), ":cursos_id" => $vo->getCursos_id(), ":professorOrientador_id" => $vo->getProfessorOrientador_id(), ":professorCoOrientador_id" => $vo->getProfessorCoOrientador_id(), ":empresas_id" => $vo->getEmpresas_id(), ":alunos_id" => $vo->getAlunos_id()];

        $success = $db->execute($query, $binds);

        if($success) {
            return $db->getLastInsertedId();
        } else {
            return null;
        }
    }

    public function update($vo) {   
        $db = new Database();
        $query = "UPDATE infoestagios SET cargaHoraria = :cargaHoraria, inicio = :inicio, termino = :termino, previsaoFim = :previsaoFim, situacao = :situacao, supervisores_id = :supervisores_id, cursos_id = :cursos_id, professorOrientador_id = :professorOrientador_id, professorCoOrientador_id = :professorCoOrientador_id, empresas_id = :empresas_id, alunos_id = :alunos_id WHERE id = :id";
        $binds = [":cargaHoraria" => $vo->getCargaHoraria(), ":inicio" => $vo->getInicio(), ":termino" => $vo->getTermino(), ":previsaoFim" => $vo->getPrevisaoFim(), ":situacao" => $vo->getSituacao(), ":supervisores_id" => $vo->getSupervisores_id(), ":cursos_id" => $vo->getCursos_id(), ":professorOrientador_id" => $vo->getProfessorOrientador_id(), ":professorCoOrientador_id" => $vo->getProfessorCoOrientador_id(), ":empresas_id" => $vo->getEmpresas_id(), ":alunos_id" => $vo->getAlunos_id(), ":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

    public function delete($vo) {
        $db = new Database(); 
        $query = "DELETE FROM infoEstagios WHERE id = :id";
        $binds = [":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

}