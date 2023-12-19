<?php

namespace Controller;

use Model\InfoEstagioModel;
use Model\DocumentoModel;
use Model\VO\DocumentoVO;

final class DocumentoController extends Controller {

    public function list() {
        $model = new DocumentoModel();
        $data = $model->selectAll();

        $model = new InfoEstagioModel();
        $infos = $model->selectAll();

        $this->loadView("listaDocumentos", [
            "documentos" => $data,
            "infos"=> $infos
        ]);
    }

    public function get() {
        $id = (isset($_GET["id"])) ? $_GET["id"] : null;

        if(empty($id)) {
            $vo = new DocumentoVO();
        } else {
            $model = new DocumentoModel();
            $vo = $model->selectOne(new DocumentoVO($id));
        }

        $model = new InfoEstagioModel();
        $infos = $model->selectAll();

        $docs = ["Ficha de Autoavaliação", "Termo de Compromisso", "Plano de Atividades", "Ficha de Avaliação", "Relatório Final"];
        $tipoDocumentos = ["Físico", "Digital"];
        $this->loadView("formDocumento", [
            "documento" => $vo,
            "tipoDocumentos" => $tipoDocumentos,
            "docs" => $docs,
            "infos"=> $infos
        ]);
    }

    public function save() {
        $id = $_POST["id"];
        $vo = new DocumentoVO($_POST["id"], $_POST["tipoDocumento"], $_POST["enderecoArquivo"], $_POST["documento"], $_POST["infoEstagios_id"]);
        $model = new DocumentoModel();
    
        // Upload de foto/arquivo
        if (!empty($_FILES["arquivo"]) && $_FILES["arquivo"]["error"] == 0) {
            $diretorio = "uploads/";
            $nomeArquivo = uniqid();
            $nomeArquivo .= ".";
            $extensao = pathinfo($_FILES["arquivo"]["name"], PATHINFO_EXTENSION);
            $nomeArquivo .= $extensao;
            $nomeCompletoArquivo = $diretorio . $nomeArquivo;
            
            if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $nomeCompletoArquivo)) {
                $vo->setEnderecoArquivo($nomeArquivo);
            } else {
                echo "Erro ao mover o arquivo.";
            }
        }
    
        if (empty($id)) {
            $return = $model->insert($vo);
        } else {
            $return = $model->update($vo);
        }
    
        sleep(2);
        $this->redirect("documentos.php");
    }
    

    public function remove() {
       if(empty($_GET["id"])){
            die("Necessário passar o ID");
        }

        $model = new DocumentoModel();
        $return = $model->delete(new DocumentoVO($_GET["id"]));

        $this->redirect("documentos.php");
    }

}