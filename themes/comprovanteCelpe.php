<?php
$this->data["empresa"] = NOME_EMPRESA;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Teste de Impressão com PDV">
    <meta name="author" content="Guilherme Hahn">

    <style>
        body{
            font-size: 12px;
        }
    </style>

    <script type="text/javascript">
        window.print();
    </script>
    <script type="text/javascript">
        window.close();
    </script>

</head>

<body>

<div style="width:48mm" align="center">

    <span style="font-size: 16px;">NOVA CASTRO</span><br/><br/>
    <span>PAGAMENTO DE CONTAS DE CONSUMO</span><br/><br/>
    <span>AFILIADO CELCOIN</span><br/>
    <span>PROTOCOLO - <?= $id ?></span><br/>
    <span><?= $dataHora ?></span><br/>
    <span>TERM 228022 AGENTE 228018 AUTE 09322</span>
    <hr>
    <span>RECEBIMENTO CONTA</span><br/>
    <span>CELPE</span><br/>
    <span><?= $codigoBarras ?></span>
    <hr>
    <span>VALOR - <?= $valor ?></span><br/>
    <span>VÁLIDO COMO RECIBO DE PAGAMENTO</span><br/>

</div>

</body>
</html>
