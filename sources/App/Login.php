<?php
namespace App;

use Models\Login_Model;
use Alertas\Alert;

class Login extends Controller{
    public function __construct($router)
    {
        $this->router = $router;
    }

    public function home(){
        parent::render("login");
    }

    public function acesso(){
        $codigoAcesso = md5($_POST["codigoAcesso"]);
        $login = new Login_Model();
        $retorno = $login->login($codigoAcesso);
        if($retorno != 1){
            Alert::error("Código de Acesso Incorreto!", "Verifique e tente novamente.", "/");
        }else{
            session_start();
            $dados = $login->dados($codigoAcesso);
            $_SESSION["usuario"] = $dados->nome;
            parent::log("FEZ LOGIN", $dados->nome);
            $this->router->redirect("/painel");
        }
    }

    public function logout(){
        session_start();
        parent::log("SAIU DO SISTEMA", $_SESSION["usuario"]);
        unset($_SESSION["usuario"]);
        $this->router->redirect("/");
    }
}