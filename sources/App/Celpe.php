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
        echo "aqui";       
        switch($retorno){
            case true:
                $this->router->redirect("/celpe/".$codigoBarras."/troco");
                break;
            case false:
                parent::renderAviso("CÓDIGO DE BARRAS INCORRETO! VERIFIQUE E TENTE NOVAMENTE.", "/painel");            
                break;
            default:
                parent::renderAviso("OCORREU UM ERRO AO PROCESSAR DADOS! ENTRE EM CONTATO COM O ADMINISTRADOR DO SISTEMA.", "/painel"); 
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

    public function aceitar(){
        $troco = $this->calcularTroco($_POST["valorPago"], $_POST["valorConta"]);
        $celpe = new Celpe_Model();
        $retorno = $celpe->salvar($_POST["valorConta"], $_POST["codigoBarras"], $troco);
        if($retorno != false){
            $output = shell_exec("pr -l 5 -o -8 -W 32 /etc/network/interfaces > /dev/lp0");
            var_dump($output);
            parent::renderAviso("PAGAMENTO REALIZADO!<br/>TROCO: <strong>R$ $troco</strong><br/>IMPRIMINDO O COMPROVANTE...", "/painel");
        }else{
            parent::renderAviso("ERRO AO REALIZAR PAGAMENTO! CONSULTE O LOG PARA MAIS INFORMAÇÕES.", "/painel");
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
        parent::render("celpeValorPago", [
            "codigoBarras" => $data["codigoBarras"],
            "valorConta" => $valorConta  = self::valor($data["codigoBarras"])
        ]);
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

    public function dados(){
        
        $comparar = $this->comparar($_POST["valorPago"], $valorConta);
        if($comparar == false){
            parent::renderAviso("Realize o pagamento novamente! Valor pago pelo cliente é inferior ao valor da conta.", "/painel");
            exit();
        }
        $troco = $this->calcularTroco($_POST["valorPago"], $valorConta);

        parent::render("celpeConfirmaDados", [
            "codigoBarras" => $dados["codigoBarras"],
            "valorConta" => $valorConta,
            "troco" => $troco
        ]);
    }
}