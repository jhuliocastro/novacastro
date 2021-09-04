<?php
require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

$router->namespace("App");

$router->get("/", "Login:home");
$router->post("/login", "Login:acesso");
$router->get("/logout", "Login:logout");

$router->group("painel");
$router->get("/", "Painel:home");

$router->dispatch();