<?php

namespace Controller;

use Model\UsuarioModel;

abstract class Controller {

    public function __construct($obrigaLogin = true){
        session_start();

        if($obrigaLogin){
            $model = new UsuarioModel();
            if($model->checkLogin() == false){ // pode ser !$model->checkLogin()
                $this->redirect("login.php");
            }
        }
    }

    public function redirect($url) {
        header("Location: " . $url);
    }


    public function loadView($view, $data = []){
        extract($data);
        include("views/" . $view . ".php");
    }

    
}