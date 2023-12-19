<?php

namespace Controller;

use Model\AreaModel;
use Model\VO\AreaVO;

final class AreaController extends Controller {

    public function list() {
        $model = new AreaModel();
        $data = $model->selectAll();

        $this->loadView("listaAreas", [
            "areas" => $data
        ]);
    }

    public function get() {
        $id = (isset($_GET["id"])) ? $_GET["id"] : null;

        if(empty($id)) {
            $vo = new AreaVO();
        } else {
            $model = new AreaModel();
            $vo = $model->selectOne(new AreaVO($id));
        }

        $this->loadView("formArea", [
            "area" => $vo
        ]);
    }

    public function save() {
        $id = $_POST["id"];
        $vo = new AreaVO($_POST["id"], $_POST["nome"]);
        $model = new AreaModel();

        if(empty($id)) {
            $return = $model->insert($vo);
        } else {
            $return = $model->update($vo);
        }

        sleep(2);
        $this->redirect("areas.php");
    }

    public function remove() {
       if(empty($_GET["id"])){
            die("Necessário passar o ID");
        }

        $model = new AreaModel();
        $return = $model->delete(new AreaVO($_GET["id"]));

        $this->redirect("areas.php");
    }

}