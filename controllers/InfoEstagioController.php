<?php

namespace Controller;

use Model\InfoEstagioModel;
use Model\SupervisorModel;
use Model\CursoModel;
use Model\ProfessorModel;
use Model\EmpresaModel;
use Model\AlunoModel;
use Model\VO\InfoEstagioVO;

final class InfoEstagioController extends Controller {

    public function list() {
        $model = new InfoEstagioModel();
        $data = $model->selectAll();

        $this->loadView("listaInfosEstagio", [
            "infosEstagio" => $data
        ]);
    }

    public function get() {
        $id = (isset($_GET["id"])) ? $_GET["id"] : null;

        if(empty($id)) {
            $vo = new InfoEstagioVO();
        } else {
            $model = new InfoEstagioModel();
            $vo = $model->selectOne(new InfoEstagioVO($id)); 
        }

        $model = new SupervisorModel();
        $supervisores = $model->selectAll();

        $model = new CursoModel();
        $cursos = $model->selectAll();

        $model = new ProfessorModel();
        $professores = $model->selectAll();

        $model = new EmpresaModel();
        $empresas = $model->selectAll();

        $model = new AlunoModel();
        $alunos = $model->selectAll();

        $situacoes = ["Em andamento", "Finalizado", "Não iniciado"];
        $this->loadView("formInfoEstagio", [
            "infoEstagio" => $vo,
            "supervisores" => $supervisores,
            "cursos"=> $cursos,
            "professores"=> $professores,
            "empresas" => $empresas,
            "alunos" => $alunos,
            "situacoes" => $situacoes
        ]);
    }

    public function save() {
        $id = $_POST["id"];
        $vo = new InfoEstagioVO($_POST["id"], $_POST["cargaHoraria"], $_POST["inicio"], $_POST["termino"], $_POST["previsaoFim"], $_POST["situacao"], $_POST["supervisores_id"], $_POST["cursos_id"], $_POST["professorOrientador_id"], $_POST["professorCoOrientador_id"], $_POST["empresas_id"], $_POST["alunos_id"]);
        $model = new InfoEstagioModel();

        if(empty($id)) {
            $return = $model->insert($vo);
        } else {
            $return = $model->update($vo);
        }

        sleep(2);
        $this->redirect("infosEstagio.php");
    }

    public function remove() {
       if(empty($_GET["id"])){
            die("Necessário passar o ID");
        }

        $model = new InfoEstagioModel();
        $return = $model->delete(new InfoEstagioVO($_GET["id"]));

        $this->redirect("infosEstagio.php");
    }

}