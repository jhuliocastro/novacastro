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

$router->group("celpe");
$router->post("/", "Celpe:home");
$router->get("/{codigoBarras}", "Celpe:dados");
$router->post("/pagamento", "Celpe:pagamento");
$router->get("/cancelar", "Celpe:cancelar");
$router->get("/aceitar/{codigoBarras}/{valor}", "Celpe:aceitar");
$router->get("/comprovante/{id}", "Celpe:comprovante");

$router->dispatch();