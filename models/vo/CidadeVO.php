<?php

namespace Model\VO;

final class CidadeVO extends VO {

    private $nome;
    private $uf;

    public function __construct($id = 0, $nome = "", $uf = "") { 
        parent::__construct($id);
        $this->nome = $nome;
        $this->uf = $uf;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getUf(){
        return $this->uf;
    }

    public function setUf($uf){
        return $this->uf = $uf;
    }
}