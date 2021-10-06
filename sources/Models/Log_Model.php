<?php
namespace Models;

use CoffeeCode\DataLayer\DataLayer;

class Log_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("log", ["descricao", "usuario"], "id");
    }

    public function cadastrar($descricao, $usuario){
        $this->descricao = $descricao;
        $this->usuario = $usuario;
        $this->save();
    }
}