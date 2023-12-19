<?php

namespace Controller;

use Model\ProfessorModel;
use Model\AreaModel;
use Model\VO\ProfessorVO;

final class ProfessorController extends Controller {

    public function list() {
        $model = new ProfessorModel();
        $data = $model->selectAll();

        $this->loadView("listaProfessores", [
            "professores" => $data
        ]);
    }

    public function get() {
        $id = (isset($_GET["id"])) ? $_GET["id"] : null;

        if(empty($id)) {
            $vo = new ProfessorVO();
        } else {
            $model = new ProfessorModel();
            $vo = $model->selectOne(new ProfessorVO($id)); 
        }

        
        $model = new AreaModel();
        $areas = $model->selectAll();

        $this->loadView("formProfessor", [
            "professor" => $vo,
            "areas" => $areas
        ]);
    }

    public function save() {
        $id = $_POST["id"];
        $vo = new ProfessorVO($_POST["id"], $_POST["siap"], $_POST["nome"], $_POST["email"], $_POST["areas_id"]);
        $model = new ProfessorModel();

        if(empty($id)) {
            $return = $model->insert($vo);
        } else {
            $return = $model->update($vo);
        }

        sleep(2);
        $this->redirect("professores.php");
    }

    public function remove() {
       if(empty($_GET["id"])){
            die("Necessário passar o ID");
        }

        $model = new ProfessorModel();
        $return = $model->delete(new ProfessorVO($_GET["id"]));

        $this->redirect("professores.php");
    }

}