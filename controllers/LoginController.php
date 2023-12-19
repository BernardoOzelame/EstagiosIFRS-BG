<?php

namespace Controller;

use Model\UsuarioModel;
use Model\VO\UsuarioVO;

final class LoginController extends Controller {

    public function __construct() {
        parent::__construct(false);
    }

    public function login() {
        $this->loadView("login");
    }

    public function fazerLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'];
            $senha = $_POST['senha'];

            $vo = new UsuarioVO(0, '', $login, $senha, '');

            $model = new UsuarioModel();
            $success = $model->doLogin($vo);

            if ($success) {
                // Credenciais corretas
                echo json_encode(['success' => true]);
            } else {
                // Credenciais incorretas
                echo json_encode(['success' => false]);
            }
        } else {
            // Requisição inválida
            echo json_encode(['success' => false, 'error' => 'Invalid request method']);
        }
    }

    public function logout() {
        $model = new UsuarioModel();
        $model->logout();
        $this->redirect("login.php");
    }    
}
