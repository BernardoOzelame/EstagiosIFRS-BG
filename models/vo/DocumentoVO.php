<?php

namespace Model\VO;

final class DocumentoVO extends VO {

    private $tipoDocumento;
    private $enderecoArquivo;
    private $documento;
    private $infoEstagios_id;
    private $infoEstagio;

    public function __construct($id = 0, $tipoDocumento = "", $enderecoArquivo = "", $documento = "", $infoEstagios_id = "", $infoEstagio = "") { 
        parent::__construct($id);
        $this->tipoDocumento = $tipoDocumento;
        $this->enderecoArquivo = $enderecoArquivo;
        $this->documento = $documento;
        $this->infoEstagios_id = $infoEstagios_id;
        $this->infoEstagio = $infoEstagio;
    }

    public function getTipoDocumento(){
        return $this->tipoDocumento;
    }

    public function setNome($tipoDocumento) {
        $this->tipoDocumento = $tipoDocumento;
    }

    public function getEnderecoArquivo(){
        return $this->enderecoArquivo;
    }

    public function setEnderecoArquivo($enderecoArquivo) {
        $this->enderecoArquivo = $enderecoArquivo;
    }

    public function getDocumento(){
        return $this->documento;
    }

    public function setDocumento($documento){
        $this->documento = $documento;
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