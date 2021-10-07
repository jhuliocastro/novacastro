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

</head>
<body>
<!-- END NAVBAR -->
<?= $this->section("content"); ?>
<!-- Metro 4 -->

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<?= $this->section("scripts"); ?>
</body>
</html>