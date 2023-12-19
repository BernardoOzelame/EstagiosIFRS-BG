<?php

namespace Controller;

use Model\CidadeModel;
use Model\VO\CidadeVO;

final class CidadeController extends Controller {

    public function list() {
        $model = new CidadeModel();
        $data = $model->selectAll();

        $this->loadView("listaCidades", [
            "cidades" => $data
        ]);
    }

    public function get() {
        $id = (isset($_GET["id"])) ? $_GET["id"] : null;

        if(empty($id)) {
            $vo = new CidadeVO();
        } else {
            $model = new CidadeModel();
            $vo = $model->selectOne(new CidadeVO($id));
        }

        $this->loadView("formCidade", [
            "cidade" => $vo
        ]);
    }

    public function save() {
        $id = $_POST["id"];
        $vo = new CidadeVO($_POST["id"], $_POST["nome"], $_POST["uf"]);
        $model = new CidadeModel();

        if(empty($id)) {
            $return = $model->insert($vo);
        } else {
            $return = $model->update($vo);
        }

        sleep(2);
        $this->redirect("cidades.php");
    }

    public function remove() {
       if(empty($_GET["id"])){
            die("Necessário passar o ID");
        }

        $model = new CidadeModel();
        $return = $model->delete(new CidadeVO($_GET["id"]));

        $this->redirect("cidades.php");
    }

}