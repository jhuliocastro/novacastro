<?php
$this->data["empresa"] = NOME_EMPRESA;
$this->layout("_theme", $this->data); ?>

<form method="post" action="/celpe/aceitar">
    <div>
        <div>
            <strong>###PAGAMENTO DE CONVÊNIO - CELPE###</strong>
        </div>
        <br/>
        <div>
            <div class="form-group">
                <label>Código de Barras: <strong><?= $codigoBarras ?></strong></label> 
                <input type="hidden" value="<?= $codigoBarras ?>" name="codigoBarras">
            </div>
            <div class="form-group">
                <label>Valor da Conta: </label><strong><?= $valorConta ?></strong>
                <input type="hidden" value="<?= $valorConta ?>" name="valorConta"> 
            </div>
            <div class="form-group">
                <label>Valor Pago pelo Cliente</label>
                <input style="width: 100%;" type="text" name="valorPago">
            </div>
        </div>
        <br/>
        <div>
            <button type="submit">EFETUAR PAGAMENTO</button>
        </div>
    </div>
</form>