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
    <title>NOVA CASTRO - PAINEL</title>
    <!-- Metro 4 -->
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
</head>
<body>
<!-- END NAVBAR -->
<?= $this->section("content"); ?>
<!-- Metro 4 -->

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<?= $this->section("scripts"); ?>
</body>
</html>