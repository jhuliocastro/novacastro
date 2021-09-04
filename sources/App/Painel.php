<?php
namespace App;

class Painel extends Controller{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function home(){
        parent::render("painel");
    }
}