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
            <button class="ribbon-button" onclick="celpe()">
                <span class="icon">
                    <img src="/assets/img/celpe.png">
                </span>
                <span class="caption">Celpe</span>
            </button>
            <button class="ribbon-button" onclick="compesa()">
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

<div class="dialog" data-role="dialog" id="dialogCelpe">
    <form action="/celpe" method="post">
        <div class="dialog-title">Celpe</div>
        <div class="dialog-content">
            <div class="form-group">
                <label>Código de Barras</label>
                <input data-role="input" id="codigoBarrasCelpe" name="codigoBarrasCelpe">
            </div>
        </div>
        <div class="dialog-actions">
            <button type="button" class="button js-dialog-close">Voltar</button>
            <button type="submit" class="button primary js-dialog-close">Consultar</button>
        </div>
    </form>
</div>

<div class="dialog" data-role="dialog" id="dialogCompesa">
    <form action="/compesa" method="post">
        <div class="dialog-title">Compesa</div>
        <div class="dialog-content">
            <div class="form-group">
                <label>Código de Barras</label>
                <input data-role="input" id="codigoBarrasCompesa" name="codigoBarrasCompesa">
            </div>
        </div>
        <div class="dialog-actions">
            <button type="button" class="button js-dialog-close">Voltar</button>
            <button type="submit" class="button primary js-dialog-close">Consultar</button>
        </div>
    </form>
</div>

<script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    $(window).on("load", function(){
        desloader();
    });

    function desloader(){
        $("#loader").animate(1000).fadeOut("slow");
        $("#carrega").animate(1000).fadeOut("slow");
    }

    function loader(){
        $("#loader").animate(1000).fadeIn("slow");
        $("#carrega").animate(1000).fadeIn("slow");
    }

    function celpe(){
        Metro.dialog.open('#dialogCelpe');
        $("#codigoBarrasCelpe").focus();
    }

    function compesa(){
        Metro.dialog.open('#dialogCompesa');
        $("#codigoBarrasCompesa").focus();
    }
</script>
<?= $this->section("scripts"); ?>
</body>
</html>