<?php

namespace Model\VO;

final class EmpresaVO extends VO {

    private $cnpj;
    private $numConvenio;
    private $nome;
    private $endereco;
    private $telefoneCelular;
    private $email;
    private $areas_id;
    private $cidades_id;
    private $cidade;
    private $area;

    public function __construct($id = 0, $cnpj = "", $numConvenio = "", $nome = "", $endereco = "", $telefoneCelular = "", $email = "", $areas_id = "", $cidades_id = "", $cidade = "", $area = "") { 
        parent::__construct($id);
        $this->cnpj = $cnpj;
        $this->numConvenio = $numConvenio;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->telefoneCelular = $telefoneCelular;
        $this->email = $email;
        $this->areas_id = $areas_id;
        $this->cidades_id = $cidades_id;
        $this->cidade = $cidade;
        $this->area = $area;
    }

    public function getCnpj(){
        return $this->cnpj;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function getNumConvenio(){
        return $this->numConvenio;
    }

    public function setNumConvenio($numConvenio) {
        $this->numConvenio = $numConvenio;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function setEndereco($endereco){
        return $this->endereco = $endereco;
    }

    public function getTelefoneCelular(){
        return $this->telefoneCelular;
    }

    public function setTelefoneCelular($telefoneCelular) {
        $this->telefoneCelular = $telefoneCelular;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getAreas_id(){
        return $this->areas_id;
    }

    public function setAreas_id($areas_id) {
        $this->areas_id = $areas_id;
    }

    public function getCidades_id(){
        return $this->cidades_id;
    }

    public function setCidades_id($cidades_id) {
        $this->cidades_id = $cidades_id;
    }

    public function getCidade(){
        return $this->cidade;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function getArea(){
        return $this->area;
    }

    public function setArea($area) {
        $this->area = $area;
    }
}