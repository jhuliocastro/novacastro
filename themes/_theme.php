<?php
if ( session_status() !== PHP_SESSION_ACTIVE )
{
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>NOVA CASTRO</title>
    <!-- Metro 4 -->
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
    <style>
        #carrega{
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: white;
        }

        #loader{
            margin: 0 auto;
            top: 48%;
        }
    </style>
</head>
<body>
<div id="carrega">
    <div id="loader" data-role="activity" data-type="square" data-style="color"></div>
</div>
<!-- START NAVBAR -->
<nav data-role="ribbonmenu">
    <ul class="tabs-holder">
        <li><a href="#contas">Pagamento de Contas</a></li>
        <li class="static" style="background-color: red;"><a href="/logout">Logout</a></li>
    </ul>

    <div class="content-holder">
        <div class="section" id="contas">
            <button class="ribbon-button" onclick="Metro.dialog.open('#dialogContratos')">
                <span class="icon">
                    <img src="/assets/img/celpe.png">
                </span>
                <span class="caption">Celpe</span>
            </button>
            <button class="ribbon-button" onclick="window.location.href='/clientes/cadastrar'">
                <span class="icon">
                    <img src="/assets/img/compesa.png">
                </span>
                <span class="caption">Compesa</span>
            </button>
        </div>
    </div>
</nav>
<!-- END NAVBAR -->
<?= $this->section("content"); ?>
<!-- Metro 4 -->
<script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    $(window).on("load", function(){
        desloader();
    });

    function desloader(){
        $("#loader").animate({top: 0}, 1000).fadeOut();
        $("#carrega").animate({top: 0}, 1000).fadeOut();
    }

    function loader(){
        $("#loader").animate({top: 0}, 1000).fadeIn();
        $("#carrega").animate({top: 0}, 1000).fadeIn();
    }
</script>
<?= $this->section("scripts"); ?>
</body>
</html>