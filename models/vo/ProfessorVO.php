<?php

namespace Model\VO;

final class ProfessorVO extends VO {

    private $siap;
    private $nome;
    private $email;
    private $areas_id;
    private $area;

    public function __construct($id = 0, $siap = "", $nome = "", $email = "", $areas_id = "", $area = "") { 
        parent::__construct($id);
        $this->siap = $siap;
        $this->nome = $nome;
        $this->email = $email;
        $this->areas_id = $areas_id;
        $this->area = $area;
    }

    public function getSiap(){
        return $this->siap;
    }

    public function setSiap($siap) {
        $this->siap = $siap;
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

    public function getAreas_id(){
        return $this->areas_id;
    }

    public function setAreas_id($areas_id){
        return $this->areas_id = $areas_id;
    }

    public function getArea(){
        return $this->area;
    }

    public function setArea($area){
        return $this->area = $area;
    }
}