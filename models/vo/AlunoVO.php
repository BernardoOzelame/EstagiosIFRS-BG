<?php

namespace Model\VO;

final class AlunoVO extends VO {

    private $matricula;
    private $nome;
    private $email;
    private $cpf;
    private $rg;
    private $endereco;
    private $telefoneCelular;
    private $anoEstagio;
    private $finalizou2Ano;
    private $cidades_id;
    private $cursos_id;
    private $cidade;
    private $curso;
    public function __construct($id = 0, $matricula = "", $nome = "", $email = "", $cpf = "", $rg = "", $endereco = "", $telefoneCelular = "", $anoEstagio = "", $finalizou2Ano = "", $cidades_id = "", $cursos_id = "", $cidade = "", $curso = "") { 
        parent::__construct($id);
        $this->matricula = $matricula;
        $this->nome = $nome;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->rg = $rg;
        $this->endereco = $endereco;
        $this->telefoneCelular = $telefoneCelular;
        $this->anoEstagio = $anoEstagio;
        $this->finalizou2Ano = $finalizou2Ano;
        $this->cidades_id = $cidades_id;
        $this->cursos_id = $cursos_id;
        $this->cidade = $cidade;
        $this->curso = $curso;
    }

    public function getMatricula(){
        return $this->matricula;
    }

    public function setMatricula($matricula){
        return $this->matricula = $matricula;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        return $this->email = $email;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function setCpf($cpf){
        return $this->cpf = $cpf;
    }

    public function getRg(){
        return $this->rg;
    }

    public function setRg($rg){
        return $this->rg = $rg;
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

    public function setTelefoneCelular($telefoneCelular){
        return $this->telefoneCelular = $telefoneCelular;
    }

    public function getAnoEstagio(){
        return $this->anoEstagio;
    }

    public function setAnoEstagio($anoEstagio){
        return $this->anoEstagio = $anoEstagio;
    }

    public function getFinalizou2Ano(){
        return $this->finalizou2Ano;
    }

    public function setFinalizou2Ano($finalizou2Ano){
        return $this->finalizou2Ano = $finalizou2Ano;
    }

    public function getCidades_id(){
        return $this->cidades_id;
    }

    public function setCidades_id($cidades_id){
        return $this->cidades_id = $cidades_id;
    }

    public function getCursos_id(){
        return $this->cursos_id;
    }

    public function setCursos_id($cursos_id){
        return $this->cursos_id = $cursos_id;
    }

    public function getCidade(){
        return $this->cidade;
    }

    public function setCidade($cidade){
        return $this->cidade = $cidade;
    }

    public function getCurso(){
        return $this->curso;
    }

    public function setCurso($curso){
        return $this->curso = $curso;
    }
}