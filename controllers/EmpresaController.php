<?php

namespace Controller;

use Model\EmpresaModel;
use Model\AreaModel;
use Model\CidadeModel;
use Model\VO\EmpresaVO;

final class EmpresaController extends Controller {

    public function list() {
        $model = new EmpresaModel();
        $data = $model->selectAll();

        $this->loadView("listaEmpresas", [
            "empresas" => $data
        ]);
    }

    public function get() {
        $id = (isset($_GET["id"])) ? $_GET["id"] : null;

        if(empty($id)) {
            $vo = new EmpresaVO();
        } else {
            $model = new EmpresaModel();
            $vo = $model->selectOne(new EmpresaVO($id));
        }

        $model = new CidadeModel();
        $cidades = $model->selectAll();

        $model = new AreaModel();
        $areas = $model->selectAll();

        $this->loadView("formEmpresa", [
            "empresa" => $vo,
            "cidades"=> $cidades,
            "areas"=> $areas
        ]);
    }

    public function save() {
        $id = $_POST["id"];
        $vo = new EmpresaVO($_POST["id"], $_POST["cnpj"], $_POST["numConvenio"], $_POST["nome"], $_POST["endereco"], $_POST["telefoneCelular"], $_POST["email"], $_POST["areas_id"], $_POST["cidades_id"]);
        $model = new EmpresaModel();

        if(empty($id)) {
            $return = $model->insert($vo);
        } else {
            $return = $model->update($vo);
        }

        sleep(2);
        $this->redirect("empresas.php");
    }

    public function remove() {
       if(empty($_GET["id"])){
            die("Necessário passar o ID");
        }

        $model = new EmpresaModel();
        $return = $model->delete(new EmpresaVO($_GET["id"]));

        $this->redirect("empresas.php");
    }

}