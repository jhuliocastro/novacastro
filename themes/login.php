<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>NOVA CASTRO - LOGIN</title>

</head>
<body class="h-vh-100 bg-brandColor2">

<form method="post" action="/login">
    <span class="mif-vpn-lock mif-4x place-right" style="margin-top: -10px;"></span>
    <hr class="thin mt-4 mb-4 bg-white">
    <div class="form-group">
        <input type="password" id="codigoAcesso" name="codigoAcesso" data-role="input" data-prepend="<span class='mif-key'>" placeholder="Código de Acesso" data-validate="required">
    </div>
    <div class="form-group mt-10">
        <button type="submit">Entrar</button>
    </div>
</form>


<script>
    $(function(){
        $("#codigoAcesso").focus();
    });
    function invalidForm(){
        var form  = $(this);
        form.addClass("ani-ring");
        setTimeout(function(){
            form.removeClass("ani-ring");
        }, 1000);
    }

    function validateForm(){
        $(".login-form").animate({
            opacity: 0
        });
    }
</script>

</body>
</html>