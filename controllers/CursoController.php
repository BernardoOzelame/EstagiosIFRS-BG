<?php

namespace Controller;

use Model\CursoModel;
use Model\VO\CursoVO;

final class CursoController extends Controller {

    public function list() {
        $model = new CursoModel();
        $data = $model->selectAll();

        $this->loadView("listaCursos", [
            "cursos" => $data
        ]);
    }

    public function get() {
        $id = (isset($_GET["id"])) ? $_GET["id"] : null;

        if(empty($id)) {
            $vo = new CursoVO();
        } else {
            $model = new CursoModel();
            $vo = $model->selectOne(new CursoVO($id));
        }

        $this->loadView("formCurso", [
            "curso" => $vo
        ]);
    }

    public function save() {
        $id = $_POST["id"];
        $vo = new CursoVO($_POST["id"], $_POST["nome"]);
        $model = new CursoModel();

        if(empty($id)) {
            $return = $model->insert($vo);
        } else {
            $return = $model->update($vo);
        }

        sleep(2);
        $this->redirect("cursos.php");
    }

    public function remove() {
       if(empty($_GET["id"])){
            die("Necessário passar o ID");
        }

        $model = new CursoModel();
        $return = $model->delete(new CursoVO($_GET["id"]));

        $this->redirect("cursos.php");
    }

}