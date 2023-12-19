<?php

namespace Model;

use Model\VO\NotaEstagioVO;
use Util\Database;

final class NotaEstagioModel extends Model {

    public function selectAll($vo = null) {
        $db = new Database();
        $data = $db->select("SELECT notasEstagio.*, infoestagios.id as infoEstagio FROM notasEstagio JOIN infoestagios ON notasEstagio.infoestagios_id = infoestagios.id ORDER BY id ASC");

        $array = [];

        foreach($data as $row){
            $vo = new NotaEstagioVO($row["id"], $row["notaProfessorOrientador"], $row["notaProfessorCoOrientador"], $row["notaEmpresa"], $row["notasRepresentante"], $row["notaSupervisor"], $row["notaAluno"], $row["notaFinal"], $row["situacao"], $row["infoEstagios_id"], $row["infoEstagio"]);
            array_push($array, $vo);
        }

        return $array;
    }

    public function selectOne($vo = null) { 
        $db = new Database();

        $query = "SELECT * FROM notasEstagio where id = :id";
        $binds = [":id" => $vo->getId()]; 
        $data = $db->select($query, $binds);

        if(count($data) == 0 ) {
            return null;
        }

        return new NotaEstagioVO($data[0]["id"], $data[0]["notaProfessorOrientador"], $data[0]["notaProfessorCoOrientador"], $data[0]["notaEmpresa"], $data[0]["notasRepresentante"], $data[0]["notaSupervisor"], $data[0]["notaAluno"], $data[0]["notaFinal"], $data[0]["situacao"], $data[0]["infoEstagios_id"]);
    }

    public function insert($vo) {
        $db = new Database();
        $query = "INSERT INTO notasEstagio (notaProfessorOrientador, notaProfessorCoOrientador, notaEmpresa, notasRepresentante, notaSupervisor, notaAluno, notaFinal, situacao, infoEstagios_id) VALUES (:notaProfessorOrientador, :notaProfessorCoOrientador, :notaEmpresa, :notasRepresentante, :notaSupervisor, :notaAluno, :notaFinal, :situacao, :infoEstagios_id)";
        
        $notaFinal = ($vo->getNotaProfessorOrientador() + $vo->getNotaProfessorCoOrientador() + $vo->getNotaEmpresa() + $vo->getNotaRepresentante() + $vo->getNotaSupervisor() + $vo->getNotaAluno()) / 6;
        
        $situacao = ($notaFinal >= 7) ? 'Aprovado' : 'Reprovado';

        $binds = [":notaProfessorOrientador" => $vo->getNotaProfessorOrientador(), ":notaProfessorCoOrientador" => $vo->getNotaProfessorCoOrientador(), ":notaEmpresa" => $vo->getNotaEmpresa(), ":notasRepresentante" => $vo->getNotaRepresentante(), ":notaSupervisor" => $vo->getNotaSupervisor(), ":notaAluno" => $vo->getNotaAluno(), ":notaFinal" => number_format($notaFinal, 2, "."), ":situacao" => $situacao, ":infoEstagios_id" => $vo->getInfoEstagios_id()];

        $success = $db->execute($query, $binds);

        if($success) {
            return $db->getLastInsertedId();
        } else {
            return null;
        }
    }

    public function update($vo) {
        $db = new Database();
        $query = "UPDATE notasEstagio SET notaProfessorOrientador = :notaProfessorOrientador, notaProfessorCoOrientador = :notaProfessorCoOrientador, notaEmpresa = :notaEmpresa, notasRepresentante = :notasRepresentante, notaSupervisor = :notaSupervisor, notaAluno = :notaAluno, notaFinal = :notaFinal, situacao = :situacao, infoEstagios_id = :infoEstagios_id WHERE id = :id";

        $notaFinal = ($vo->getNotaProfessorOrientador() + $vo->getNotaProfessorCoOrientador() + $vo->getNotaEmpresa() + $vo->getNotaRepresentante() + $vo->getNotaSupervisor() + $vo->getNotaAluno()) / 6;
        
        $situacao = ($notaFinal >= 7) ? 'Aprovado' : 'Reprovado';

        $binds = [":notaProfessorOrientador" => $vo->getNotaProfessorOrientador(), ":notaProfessorCoOrientador" => $vo->getNotaProfessorCoOrientador(), ":notaEmpresa" => $vo->getNotaEmpresa(), ":notasRepresentante" => $vo->getNotaRepresentante(), ":notaSupervisor" => $vo->getNotaSupervisor(), ":notaAluno" => $vo->getNotaAluno(), ":notaFinal" => number_format($notaFinal, 2, "."), ":situacao" => $situacao, ":infoEstagios_id" => $vo->getInfoEstagios_id(), ":id" => $vo->getId()];


        return $db->execute($query, $binds);
    }


    public function delete($vo) {
        $db = new Database(); 
        $query = "DELETE FROM notasEstagio WHERE id = :id";
        $binds = [ ":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }
}
