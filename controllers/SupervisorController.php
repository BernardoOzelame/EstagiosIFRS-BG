<?php

namespace Controller;

use Model\SupervisorModel;
use Model\EmpresaModel;
use Model\VO\SupervisorVO;

final class SupervisorController extends Controller {

    public function list() {
        $model = new SupervisorModel();
        $data = $model->selectAll();

        $this->loadView("listaSupervisores", [
            "supervisores" => $data
        ]);
    }

    public function get() {
        $id = (isset($_GET["id"])) ? $_GET["id"] : null;

        if(empty($id)) {
            $vo = new SupervisorVO();
        } else {
            $model = new SupervisorModel();
            $vo = $model->selectOne(new SupervisorVO($id));
        }

        $model = new EmpresaModel();
        $empresas = $model->selectAll();

        $this->loadView("formSupervisor", [
            "supervisor" => $vo,
            "empresas"=> $empresas
        ]);
    }

    public function save() {
        $id = $_POST["id"];
        $vo = new SupervisorVO($_POST["id"], $_POST["nome"], $_POST["email"], $_POST["cargo"], $_POST["formacao"], $_POST["telefoneCelular"], $_POST["empresas_id"]);
        $model = new SupervisorModel();

        if(empty($id)) {
            $return = $model->insert($vo);
        } else {
            $return = $model->update($vo);
        }

        sleep(2);
        $this->redirect("supervisores.php");
    }

    public function remove() {
       if(empty($_GET["id"])){
            die("Necessário passar o ID");
        }

        $model = new SupervisorModel();
        $return = $model->delete(new SupervisorVO($_GET["id"]));

        $this->redirect("supervisores.php");
    }

}