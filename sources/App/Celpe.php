<?php
namespace App;

use Alertas\Alert;
use Models\Celpe_Model;
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
                $this->router->redirect("/celpe/".$codigoBarras."/troco");
                break;
            case false:
                Alert::warning("CÓDIGO DE BARRAS INCORRETO!", "VERIQUE E TENTE NOVAMENTE", "/painel");
                break;
            default:
                Alert::error("OCORREU UM ERRO AO PROCESSAR DADOS!", "ENTRE EM CONTATO COM O ADMINISTRADOR DO SISTEMA", "/painel");
                break;
        }
    }

    public function codigoBarras(){
        parent::render("celpeCodigoBarras");
    }

    public function cancelar(){
        parent::log("CANCELOU PAGAMENTO CELPE");
        Alert::info("Pagamento Cancelado com Sucesso!", "", "/painel");
    }

    public function aceitar($data){
        $celpe = new Celpe_Model();
        $retorno = $celpe->salvar($data["valor"], $data["codigoBarras"], $data["troco"]);
        if($retorno != false){
            echo "<script>window.open(\"/celpe/comprovante/$retorno\", '_blank');</script>";
            Alert::cron("success", "PAGAMENTO REALIZADO! Troco: R$ ".$data["troco"], "AGUARDE A IMPRESSÃO DO COMPROVANTE.", "/painel", 20);
        }else{
            Alert::error("ERRO AO REALIZAR PAGAMENTO!", "CONSULTE O LOG PARA MAIS INFORMAÇÕES.", "/painel");
        }
    }

    public function comprovante($data){
        $celpe = new Celpe_Model();
        $dados = $celpe->retornoID($data["id"]);
        parent::render("comprovanteCelpe", [
            "id" => $dados->id,
            "dataHora" => date("d/m/Y H:i:s", strtotime($dados->created_at)),
            "codigoBarras" => $dados->codigoBarras,
            "valor" => "R$ ".$dados->valor
        ]);
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

    public function infoTroco($data){
        Alert::input("Informe o valor pago pelo cliente", "text", "/celpe/".$data["codigoBarras"]);
    }

    private function comparar($valor1, $valor2){
        $valor1 = str_replace("R$ ", "", $valor1);
        $valor2 = str_replace("R$ ", "", $valor2);
        $valor1 = str_replace(",", ".", $valor1);
        $valor2 = str_replace(",", ".", $valor2);
        if($valor1 > $valor2 || $valor1 == $valor2){
            return true;
        }else{
            return false;
        }
    }

    private function calcularTroco($valorPago, $valorConta){
        $valorPago = str_replace("R$ ", "", $valorPago);
        $valorConta = str_replace("R$ ", "", $valorConta);
        $valorPago = str_replace(",", ".", $valorPago);
        $valorConta = str_replace(",", ".", $valorConta);
        $troco = $valorPago - $valorConta;
        $troco = str_replace(".", ",", $troco);
        return $troco;
    }

    public function dados($dados){
        $valorConta  = self::valor($dados["codigoBarras"]);
        $comparar = $this->comparar($dados["valorPago"], $valorConta);
        if($comparar == false){
            Alert::error("Realize o pagamento novamente!", "Valor pago pelo cliente é inferior ao valor da conta.", "/painel");
            exit();
        }
        $troco = $this->calcularTroco($dados["valorPago"], $valorConta);
        Alert::question("Confirma pagamento da conta no valor de ".$valorConta."?", $dados["codigoBarras"], "/celpe/aceitar/".$dados["codigoBarras"]."/".$valorConta."/".$troco, "/celpe/cancelar");
    }
}