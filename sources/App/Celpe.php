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

    public function cancelar(){
        Alert::info("Pagamento Cancelado com Sucesso!", "", "/painel");
    }

    private static function valor($codigoBarras){
        $valor = 0;

        if($codigoBarras[16] == 0){
            $valor = $codigoBarras[12].$codigoBarras[13].",".$codigoBarras[14].$codigoBarras[15];
        }else{
            $valor = $codigoBarras[12].$codigoBarras[13].$codigoBarras[14].",".$codigoBarras[15].$codigoBarras[16];
        }

        $valor = "R$ ".$valor;

        return $valor;
    }

    public function dados($dados){
        Alert::question("Confirma pagamento da conta no valor de ".self::valor($dados["codigoBarras"])."?", self::valor($dados["codigoBarras"]), "/celpe/aceitar/".$dados["codigoBarras"]."/".self::valor($dados["codigoBarras"]), "/celpe/cancelar");
        die();
        parent::render("celpe", [
            "codigoBarras" => $dados["codigoBarras"],
            "valor" => self::valor($dados["codigoBarras"])
        ]);
    }
}