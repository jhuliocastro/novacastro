<?php
$this->data["empresa"] = NOME_EMPRESA;
$this->layout("_theme", $this->data); ?>

<form method="post" action="/celpe/pagamento">
    <div class="card">
        <div class="card-header">
            Pagamento de Covênio - <strong>CELPE</strong>
        </div>
        <div class="card-content p-2">
            <div class="form-group">
                <label>Código de Barras</label>
                <input type="text" name="codigoBarras" data-role="input" value="<?= $codigoBarras ?>" readonly>
            </div>
            <div class="form-group">
                <label>Valor</label>
                <input type="text" data-role="input" value="<?= $valor ?>" readonly>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="button primary">Realizar Pagamento</button>
        </div>
    </div>
</form>