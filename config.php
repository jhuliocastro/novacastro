<?php
const URL_BASE = "http://novasolucoes/";
const NOME_EMPRESA = "NOVA CASTRO";

define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "provedornova.com.br",
    "port" => "3306",
    "dbname" => "provedo4_sistema",
    "username" => "provedo4_sistema",
    "passwd" => "20ca40bo",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);