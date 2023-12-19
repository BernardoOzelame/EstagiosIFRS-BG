<?php

namespace Controller;

use Model\NotaEstagioModel;
use Model\InfoEstagioModel;
use Model\VO\NotaEstagioVO;

final class NotaEstagioController extends Controller {

    public function list() {
        $model = new NotaEstagioModel();
        $data = $model->selectAll();

        $model = new InfoEstagioModel();
        $infos = $model->selectAll();

        $this->loadView("listaNotasEstagio", [
            "notasEstagio" => $data,
            "infos"=> $infos
        ]);
    }

    public function get() {
        $id = (isset($_GET["id"])) ? $_GET["id"] : null;

        if(empty($id)) {
            $vo = new NotaEstagioVO();
        } else {
            $model = new NotaEstagioModel();
            $vo = $model->selectOne(new NotaEstagioVO($id));
        }

        $model = new InfoEstagioModel();
        $infos = $model->selectAll();

        $this->loadView("formNotaEstagio", [
            "notaEstagio" => $vo,
            "infos"=> $infos
        ]);
    }

    public function save() {
        $id = $_POST["id"];
        $vo = new NotaEstagioVO($_POST["id"], $_POST["notaProfessorOrientador"], $_POST["notaProfessorCoOrientador"], $_POST["notaEmpresa"], $_POST["notaRepresentante"], $_POST["notaSupervisor"], $_POST["notaAluno"], $_POST["notaFinal"], $_POST["situacao"], $_POST["infoEstagios_id"]);
        $model = new NotaEstagioModel();

        if(empty($id)) {
            $return = $model->insert($vo);
        } else {
            $return = $model->update($vo);
        }

        sleep(2);
        $this->redirect("notasEstagio.php");
    }

    public function remove() {
        if(empty($_GET["id"])){
            die("Necessário passar o ID");
        }

        $model = new NotaEstagioModel();
        $return = $model->delete(new NotaEstagioVO($_GET["id"]));

        $this->redirect("notasEstagio.php");
    }
}
