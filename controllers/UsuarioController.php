<?php

namespace Controller;

use Model\UsuarioModel;
use Model\VO\UsuarioVO;

final class UsuarioController extends Controller {

    public function list() {
        $model = new UsuarioModel();
        $data = $model->selectAll();

        $this->loadView("listaUsuarios", [
            "usuarios" => $data
        ]);
    }

    public function get() {
        $id = (isset($_GET["id"])) ? $_GET["id"] : null;

        if(empty($id)) {
            $vo = new UsuarioVO();
        } else {
            $model = new UsuarioModel();
            $vo = $model->selectOne(new UsuarioVO($id)); 
        }

        $tipoUsuario = ["Administrador", "Empresa", "Estagiário"];
        $this->loadView("formUsuario", [
            "usuario" => $vo,
            "tiposUsuario" => $tipoUsuario
        ]);
    }

    public function save() {
        $id = $_POST["id"];
        $vo = new UsuarioVO($_POST["id"], $_POST["nome"], $_POST["login"], $_POST["senha"], $_POST["tipoUsuario"]);
        $model = new UsuarioModel();

        if(empty($id)) {
            $return = $model->insert($vo);
        } else {
            $return = $model->update($vo);
        }

        sleep(2);
        $this->redirect("usuarios.php");
    }

    public function remove() {
        if(empty($_GET["id"])){
             die("Necessário passar o ID");
         }
 
         $model = new UsuarioModel();
         $return = $model->delete(new UsuarioVO($_GET["id"]));
 
         $this->redirect("usuarios.php");
     }
}