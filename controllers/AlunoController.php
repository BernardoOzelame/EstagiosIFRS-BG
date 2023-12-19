<?php

namespace Controller;

use Model\AlunoModel;
use Model\CidadeModel;
use Model\CursoModel;
use Model\VO\AlunoVO;

final class AlunoController extends Controller {

    public function list() {
        $model = new AlunoModel();
        $data = $model->selectAll();

        $this->loadView("listaAlunos", [
            "alunos" => $data
        ]);
    }

    public function get() {
        $id = (isset($_GET["id"])) ? $_GET["id"] : null;

        if(empty($id)) {
            $vo = new AlunoVO();
        } else {
            $model = new AlunoModel();
            $vo = $model->selectOne(new AlunoVO($id)); 
        }

        $model = new CidadeModel();
        $cidades = $model->selectAll();

        $model = new CursoModel();
        $cursos = $model->selectAll();

        $this->loadView("formAluno", [
            "aluno" => $vo,
            "cidades" => $cidades,
            "cursos" => $cursos
        ]);
    }

    public function save() {
        $id = $_POST["id"];
        $vo = new AlunoVO($_POST["id"], $_POST["matricula"], $_POST["nome"], $_POST["email"], $_POST["cpf"], $_POST["rg"], $_POST["endereco"], $_POST["telefoneCelular"], $_POST["anoEstagio"], $_POST["finalizou2ano"], $_POST["cidades_id"], $_POST["cursos_id"]);
        $model = new AlunoModel();

        if(empty($id)) {
            $return = $model->insert($vo);
        } else {
            $return = $model->update($vo);
        }

        sleep(2);
        $this->redirect("alunos.php");
    }

    public function remove() {
       if(empty($_GET["id"])){
            die("Necessário passar o ID");
        }

        $model = new AlunoModel();
        $return = $model->delete(new AlunoVO($_GET["id"]));

        $this->redirect("alunos.php");
    }

}