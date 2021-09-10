<?php
namespace App;

use Alertas\Alert;
use Tagliatti\BoletoValidator\BoletoValidator;

class Celpe extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
    }

    public function home(){
        $codigoBarras = $_POST["codigoBarrasCelpe"];
        $retorno = BoletoValidator::convenio($codigoBarras);
        switch($retorno){
            case true:
                $this->router->redirect("/celpe/".$codigoBarras);
                break;
            case false:
                Alert::warning("CÓDIGO DE BARRAS INCORRETO!", "VERIQUE E TENTE NOVAMENTE", "/painel");
                break;
            default:
                Alert::error("OCORREU UM ERRO AO PROCESSAR DADOS!", "ENTRE EM CONTATO COM O ADMINISTRADOR DO SISTEMA", "/painel");
                break;
        }
    }

    public function dados($dados){
        var_dump($dados);
    }
}