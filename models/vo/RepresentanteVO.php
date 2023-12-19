<?php

namespace Model\VO;

final class RepresentanteVO extends VO {

    private $nome;
    private $funcao;
    private $cpf;
    private $rg;
    private $empresas_id;
    private $empresa;

    public function __construct($id = 0, $nome = "", $funcao = "", $cpf = "", $rg = "", $empresas_id = "", $empresa = "") { 
        parent::__construct($id);
        $this->nome = $nome;
        $this->funcao = $funcao;
        $this->cpf = $cpf;
        $this->rg = $rg;
        $this->empresas_id = $empresas_id;
        $this->empresa = $empresa;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getFuncao(){
        return $this->funcao;
    }

    public function setFuncao($funcao) {
        $this->funcao = $funcao;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getRg(){
        return $this->rg;
    }

    public function setRg($rg){
        return $this->rg = $rg;
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