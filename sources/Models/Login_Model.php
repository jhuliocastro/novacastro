<?php
namespace Models;

use CoffeeCode\DataLayer\DataLayer;

class Login_Model extends DataLayer{
    public function __construct()
    {
        parent::__construct("usuarios", ["codigoAcesso"], "id", false);
    }

    public function login($codigoAcesso){
        return $this->find("codAcesso=:cod", "cod=$codigoAcesso")->count();
    }

    public function dados($codigoAcesso){
        return $this->find("codAcesso=:cod", "cod=$codigoAcesso")->fetch();
    }
}