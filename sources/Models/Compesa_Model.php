<?php
namespace Models;

use CoffeeCode\DataLayer\DataLayer;
use App\Controller;

class Compesa_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("contas", [], "id", true);
    }

    public function salvar($valor, $codigoBarras){
        $valor = str_replace("R$ ", "", $valor);
        $this->valor = $valor;
        $this->codigoBarras = $codigoBarras;
        $this->tipo = "compesa";
        $this->save();
        if($this->fail()){
            $controller = new Controller();
            $controller->log("ERRO AO SALVAR CONTA NO BANCO DE DADOS");
            $controller->log($this->fail()->getMessage());
            $retorno = false;
        }else{
            $retorno = $this->data->id;
        }

        return $retorno;
    }

    public function retornoID($id){
        return $this->findById($id);
    }
}