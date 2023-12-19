<?php

namespace Model\VO;

final class InfoEstagioVO extends VO {

    private $cargaHoraria;
    private $inicio;
    private $termino;
    private $previsaoFim;
    private $situacao;
    private $supervisores_id;
    private $cursos_id;
    private $professorOrientador_id;
    private $professorCoOrientador_id;
    private $empresas_id;
    private $alunos_id;
    private $supervisor;
    private $curso;
    private $professorOrientador;
    private $professorCoOrientador;
    private $empresa;
    private $aluno;

    public function __construct($id = 0, $cargaHoraria = "", $inicio = "", 
    $termino = "", $previsaoFim = "", $situacao = "", $supervisores_id = "", 
    $cursos_id = "", $professorOrientador_id = "", 
    $professorCoOrientador_id = "", $empresas_id = "", $alunos_id = "", 
    $supervisor = "", $curso = "", $professorOrientador = "", $professorCoOrientador = "", 
    $empresa = "", $aluno = "") { 
        parent::__construct($id);
        $this->cargaHoraria = $cargaHoraria;
        $this->inicio = $inicio;
        $this->termino = $termino;
        $this->previsaoFim = $previsaoFim;
        $this->situacao = $situacao;
        $this->supervisores_id = $supervisores_id;
        $this->cursos_id = $cursos_id;
        $this->professorOrientador_id = $professorOrientador_id;
        $this->professorCoOrientador_id = $professorCoOrientador_id;
        $this->empresas_id = $empresas_id;
        $this->alunos_id = $alunos_id;
        $this->supervisor = $supervisor;
        $this->curso = $curso;
        $this->professorOrientador = $professorOrientador;
        $this->professorCoOrientador = $professorCoOrientador;
        $this->empresa = $empresa;
        $this->aluno = $aluno;
    }

    public function getCargaHoraria(){
        return $this->cargaHoraria;
    }

    public function setCargaHoraria($cargaHoraria) {
        $this->cargaHoraria = $cargaHoraria;
    }

    public function getInicio(){
        return $this->inicio;
    }

    public function setInicio($inicio) {
        $this->inicio = $inicio;
    }

    public function getTermino(){
        return $this->termino;
    }

    public function setTermino($termino) {
        $this->termino = $termino;
    }

    public function getPrevisaoFim(){
        return $this->previsaoFim;
    }

    public function setPrevisaoFim($previsaoFim){
        $this->previsaoFim = $previsaoFim;
    }

    public function getSituacao(){
        return $this->situacao;
    }

    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    public function getSupervisores_id(){
        return $this->supervisores_id;
    }

    public function setSupervisores_id($supervisores_id) {
        $this->supervisores_id = $supervisores_id;
    }

    public function getCursos_id(){
        return $this->cursos_id;
    }

    public function setCursos_id($cursos_id) {
        $this->cursos_id = $cursos_id;
    }

    public function getProfessorOrientador_id(){
        return $this->professorOrientador_id;
    }

    public function setProfessorOrientador_id($professorOrientador_id) {
        $this->professorOrientador_id = $professorOrientador_id;
    }

    public function getProfessorCoOrientador_id(){
        return $this->professorCoOrientador_id;
    }

    public function setProfessorCoOrientador_id($professorCoOrientador_id) {
        $this->professorCoOrientador_id = $professorCoOrientador_id;
    }

    public function getEmpresas_id(){
        return $this->empresas_id;
    }

    public function setEmpresas_id($empresas_id) {
        $this->empresas_id = $empresas_id;
    }

    public function getAlunos_id(){
        return $this->alunos_id;
    }

    public function setAlunos_id($alunos_id) {
        $this->alunos_id = $alunos_id;
    }



    

    public function getSupervisor(){
        return $this->supervisor;
    }

    public function setSupervisor($supervisor) {
        $this->supervisor = $supervisor;
    }

    public function getCurso(){
        return $this->curso;
    }

    public function setCurso($curso) {
        $this->curso = $curso;
    }

    public function getProfessorOrientador(){
        return $this->professorOrientador;
    }

    public function setProfessorOrientador($professorOrientador) {
        $this->professorOrientador = $professorOrientador;
    }

    public function getProfessorCoOrientador(){
        return $this->professorCoOrientador;
    }

    public function setProfessorCoOrientador($professorCoOrientador) {
        $this->professorCoOrientador = $professorCoOrientador;
    }

    public function getEmpresa(){
        return $this->empresa;
    }

    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    public function getAluno(){
        return $this->aluno;
    }

    public function setAluno($aluno) {
        $this->aluno = $aluno;
    }
    
}