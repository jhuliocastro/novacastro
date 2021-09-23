<?php
namespace App;

use Alertas\Alert;
use Tagliatti\BoletoValidator\BoletoValidator;
use Models\Compesa_Model;

class Compesa extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
    }

    public function home(){
        $codigoBarras = $_POST["codigoBarrasCompesa"];
        $retorno = BoletoValidator::convenio($codigoBarras);
        switch($retorno){
            case true:
                $this->router->redirect("/compesa/".$codigoBarras);
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
        Alert::question("Confirma pagamento da conta no valor de ".self::valor($dados["codigoBarras"])."?", self::valor($dados["codigoBarras"]), "/compesa/aceitar/".$dados["codigoBarras"]."/".self::valor($dados["codigoBarras"]), "/compesa/cancelar");
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

    public function aceitar($data){
        $compesa = new Compesa_Model();
        $retorno = $compesa->salvar($data["valor"], $data["codigoBarras"]);
        if($retorno != false){
            echo "<script>window.open(\"/compesa/comprovante/$retorno\", '_blank');</script>";
            Alert::cron("success", "PAGAMENTO REALIZADO!", "AGUARDE A IMPRESSÃO DO COMPROVANTE.", "/painel", 5);
        }else{
            Alert::error("ERRO AO REALIZAR PAGAMENTO!", "CONSULTE O LOG PARA MAIS INFORMAÇÕES.", "/painel");
        }
    }

    public function comprovante($data){
        $compesa = new Compesa_Model();
        $dados = $compesa->retornoID($data["id"]);
        parent::render("comprovanteCompesa", [
            "id" => $dados->id,
            "dataHora" => date("d/m/Y H:i:s", strtotime($dados->created_at)),
            "codigoBarras" => $dados->codigoBarras,
            "valor" => "R$ ".$dados->valor
        ]);
    }

    public function cancelar(){
        parent::log("CANCELOU PAGAMENTO COMPESA");
        Alert::info("Pagamento Cancelado com Sucesso!", "", "/painel");
    }
}