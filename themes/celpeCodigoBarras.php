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
                <input style="width: 1000px;" type="text" name="codigoBarras">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="button primary">LER</button>
        </div>
    </div>
</form>