<?php
namespace App;

use League\Plates\Engine;
use Models\Log_Model;

class Controller{
    private $caminhoViews = __DIR__."/../../themes";

    public function __construct($router){
        $this->router = $router;
        $this->userActive();
    }

    public function render($view, array $dados = []){
        $template = new Engine($this->caminhoViews);
        echo $template->render($view, $dados);
    }

    public function log($descricao, $usuario = null){
        if($usuario == null){
            session_start();
            $usuario = $_SESSION["usuario"];
        }
        $log = new Log_Model();
        $log->cadastrar($descricao, $usuario);
    }

    private function userActive(){
        session_start();
        if(!isset($_SESSION["usuario"])):
            $this->router->redirect("/");
        endif;
    }
}