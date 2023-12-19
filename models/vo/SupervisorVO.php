<?php

namespace Model\VO;

final class SupervisorVO extends VO {

    private $nome;
    private $email;
    private $cargo;
    private $formacao;
    private $telefoneCelular;
    private $empresas_id;
    private $empresa;

    public function __construct($id = 0, $nome = "", $email = "", $cargo = "", $formacao = "", $telefoneCelular = "", $empresas_id = "", $empresa = "") { 
        parent::__construct($id);
        $this->nome = $nome;
        $this->email = $email;
        $this->cargo = $cargo;
        $this->formacao = $formacao;
        $this->telefoneCelular = $telefoneCelular;
        $this->empresas_id = $empresas_id;
        $this->empresa = $empresa;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getCargo(){
        return $this->cargo;
    }

    public function setCargo($cargo){
        $this->cargo = $cargo;
    }

    public function getFormacao(){
        return $this->formacao;
    }

    public function setFormacao($formacao){
        return $this->formacao = $formacao;
    }

    public function getTelefoneCelular(){
        return $this->telefoneCelular;
    }

    public function setTelefoneCelular($telefoneCelular){
        $this->telefoneCelular = $telefoneCelular;
    }

    public function getEmpresas_id(){
        return $this->empresas_id;
    }

    public function setEmpresas_id($empresas_id){
        $this->empresas_id = $empresas_id;
    }

    public function getEmpresa(){
        return $this->empresa;
    }

    public function setEmpresa($empresa){
        $this->empresa = $empresa;
    }
}