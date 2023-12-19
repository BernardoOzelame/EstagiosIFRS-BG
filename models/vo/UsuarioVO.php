<?php

namespace Model\VO;

final class UsuarioVO extends VO {

    private $nome;
    private $login;
    private $senha;
    private $tipoUsuario;

    public function __construct($id = 0, $nome = "", $login = "", $senha = "", $tipoUsuario = "") { 
        parent::__construct($id);
        $this->nome = $nome;
        $this->login = $login;
        $this->senha = $senha;
        $this->tipoUsuario = $tipoUsuario;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getLogin(){
        return $this->login;
    }

    public function setLogin($login){
        return $this->login = $login;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($senha){
        return $this->senha = $senha;
    }

    public function getTipoUsuario(){
        return $this->tipoUsuario;
    }

    public function setTipoUsuario($tipoUsuario){
        return $this->tipoUsuario = $tipoUsuario;
    }
}