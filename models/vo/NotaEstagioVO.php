<?php

namespace Model\VO;

final class NotaEstagioVO extends VO {

    private $notaProfessorOrientador;
    private $notaProfessorCoOrientador;
    private $notaEmpresa;
    private $notaRepresentante;
    private $notaSupervisor;
    private $notaAluno;
    private $notaFinal;
    private $situacao;
    private $infoEstagios_id;
    private $infoEstagio;

    public function __construct($id = 0, $notaProfessorOrientador = "", $notaProfessorCoOrientador = "", $notaEmpresa = "", $notaRepresentante = "", $notaSupervisor = "", $notaAluno = "", $notaFinal = "", $situacao = "", $infoEstagios_id = "", $infoEstagio = "") {
        parent::__construct($id);
        $this->notaProfessorOrientador = $notaProfessorOrientador;
        $this->notaProfessorCoOrientador = $notaProfessorCoOrientador;
        $this->notaEmpresa = $notaEmpresa;
        $this->notaRepresentante = $notaRepresentante;
        $this->notaSupervisor = $notaSupervisor;
        $this->notaAluno = $notaAluno;
        $this->notaFinal = $notaFinal;
        $this->situacao = $situacao;
        $this->infoEstagios_id = $infoEstagios_id;
        $this->infoEstagio = $infoEstagio;
    }

    public function getNotaProfessorOrientador(){
        return $this->notaProfessorOrientador;
    }

    public function setNotaProfessorOrientador($notaProfessorOrientador) {
        $this->notaProfessorOrientador = $notaProfessorOrientador;
    }

    public function getNotaProfessorCoOrientador(){
        return $this->notaProfessorCoOrientador;
    }

    public function setNotaProfessorCoOrientador($notaProfessorCoOrientador) {
        $this->notaProfessorCoOrientador = $notaProfessorCoOrientador;
    }

    public function getNotaEmpresa(){
        return $this->notaEmpresa;
    }

    public function setNotaEmpresa($notaEmpresa) {
        $this->notaEmpresa = $notaEmpresa;
    }

    public function getNotaRepresentante(){
        return $this->notaRepresentante;
    }

    public function setNotaRepresentante($notaRepresentante){
        return $this->notaRepresentante = $notaRepresentante;
    }

    public function getNotaSupervisor(){
        return $this->notaSupervisor;
    }

    public function setNotaSupervisor($notaSupervisor) {
        $this->notaSupervisor = $notaSupervisor;
    }

    public function getNotaAluno(){
        return $this->notaAluno;
    }

    public function setNotaAluno($notaAluno) {
        $this->notaAluno = $notaAluno;
    }

    public function getNotaFinal(){
        return $this->notaFinal;
    }

    public function setNotaFinal($notaFinal) {
        $this->notaFinal = $notaFinal;
    }

    public function getSituacao(){
        return $this->situacao;
    }

    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    public function getInfoEstagios_id(){
        return $this->infoEstagios_id;
    }

    public function setInfoEstagios_id($infoEstagios_id){
        $this->infoEstagios_id = $infoEstagios_id;
    }

    public function getInfoEstagio(){
        return $this->infoEstagio;
    }

    public function setInfoEstagio($infoEstagio){
        $this->infoEstagio = $infoEstagio;
    }
}