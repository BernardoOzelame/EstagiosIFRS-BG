<?php

namespace Controller;

use Model\RepresentanteModel;
use Model\EmpresaModel;
use Model\VO\RepresentanteVO;

final class RepresentanteController extends Controller {

    public function list() {
        $model = new RepresentanteModel();
        $data = $model->selectAll();

        $this->loadView("listaRepresentantes", [
            "representantes" => $data
        ]);
    }

    public function get() {
        $id = (isset($_GET["id"])) ? $_GET["id"] : null;

        if(empty($id)) {
            $vo = new RepresentanteVO();
        } else {
            $model = new RepresentanteModel();
            $vo = $model->selectOne(new RepresentanteVO($id));
        }

        $model = new EmpresaModel();
        $empresas = $model->selectAll();

        $this->loadView("formRepresentante", [
            "representante" => $vo,
            "empresas"=> $empresas
        ]);
    }

    public function save() {
        $id = $_POST["id"];
        $vo = new RepresentanteVO($_POST["id"], $_POST["nome"], $_POST["funcao"], $_POST["cpf"], $_POST["rg"], $_POST["empresas_id"]);
        $model = new RepresentanteModel();

        if(empty($id)) {
            $return = $model->insert($vo);
        } else {
            $return = $model->update($vo);
        }

        sleep(2);
        $this->redirect("representantes.php");
    }

    public function remove() {
       if(empty($_GET["id"])){
            die("Necessário passar o ID");
        }

        $model = new RepresentanteModel();
        $return = $model->delete(new RepresentanteVO($_GET["id"]));

        $this->redirect("representantes.php");
    }

}