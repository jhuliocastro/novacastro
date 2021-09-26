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
$router->get("/{codigoBarras}/{valorPago}", "Celpe:dados");
$router->get("/{codigoBarras}/troco", "Celpe:infoTroco");
$router->post("/pagamento", "Celpe:pagamento");
$router->get("/cancelar", "Celpe:cancelar");
$router->get("/aceitar/{codigoBarras}/{valor}/{troco}", "Celpe:aceitar");
$router->get("/comprovante/{id}", "Celpe:comprovante");

$router->group("compesa");
$router->post("/", "Compesa:home");
$router->get("/{codigoBarras}/{valorPago}", "Compesa:dados");
$router->get("/{codigoBarras}/troco", "Compesa:infoTroco");
$router->get("/aceitar/{codigoBarras}/{valor}", "Compesa:aceitar");
$router->get("/cancelar", "Compesa:cancelar");
$router->get("/comprovante/{id}", "Compesa:comprovante");

$router->dispatch();

if ($router->error()) {
    var_dump($router->error());
}