<?php

namespace Model;

use Model\VO\DocumentoVO;
use Util\Database;

final class DocumentoModel extends Model {

    public function selectAll($vo = null) {
        $db = new Database();
        $data = $db->select("SELECT documentos.*, infoestagios.id as infoEstagio FROM documentos JOIN infoestagios ON documentos.infoestagios_id = infoestagios.id ORDER BY id ASC");

        $array = [];

        foreach($data as $row){
            $vo = new DocumentoVO($row["id"], $row["tipoDocumento"], $row["enderecoArquivo"], $row["documento"], $row["infoEstagios_id"], $row["infoEstagio"]);
            array_push($array, $vo);
        }

        return $array;
    }

    public function selectOne($vo = null) {
        $db = new Database();

        $query = "SELECT * FROM documentos where id = :id";
        $binds = [":id" => $vo->getId()]; 
        $data = $db->select($query, $binds);

        if(count($data) == 0 ) {
            return null;
        }

        return new DocumentoVO($data[0]["id"], $data[0]["tipoDocumento"], $data[0]["enderecoArquivo"], $data[0]["documento"], $data[0]["infoEstagios_id"]);
    }

    public function insert($vo) {
        $db = new Database();
        $query = "INSERT INTO documentos (tipoDocumento, enderecoArquivo, documento, infoEstagios_id) VALUES (:tipoDocumento, :enderecoArquivo, :documento, :infoEstagios_id)";
        $binds = [":tipoDocumento" => $vo->getTipoDocumento(), ":enderecoArquivo" => $vo->getEnderecoArquivo(), ":documento" => $vo->getDocumento(), ":infoEstagios_id" => $vo->getInfoEstagios_id()];

        $success = $db->execute($query, $binds);

        if($success) {
            return $db->getLastInsertedId();
        } else {
            return null;
        }
    }

    public function update($vo) {   
        $db = new Database();
        $binds = [":tipoDocumento" => $vo->getTipoDocumento(), ":documento" => $vo->getDocumento(), ":infoEstagios_id" => $vo->getInfoEstagios_id(), ":id" => $vo->getId()];

        if(empty($vo->getEnderecoArquivo())){
            $query = "UPDATE documentos SET tipoDocumento = :tipoDocumento, documento = :documento, infoEstagios_id = :infoEstagios_id WHERE id = :id";
        } else{
            $query = "UPDATE documentos SET tipoDocumento = :tipoDocumento, enderecoArquivo = :enderecoArquivo WHERE id = :id";
            $binds[":enderecoArquivo"] = $vo->getEnderecoArquivo();
        }
        

        return $db->execute($query, $binds);
    }

    public function delete($vo) {
        $db = new Database();
        $query = "DELETE FROM documentos WHERE id = :id";
        $binds = [":id" => $vo->getId()];

        return $db->execute($query, $binds);
    }

}