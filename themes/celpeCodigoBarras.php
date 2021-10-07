<?php
$this->data["empresa"] = NOME_EMPRESA;
$this->layout("_theme", $this->data); ?>

<form method="post" action="/celpe">
    <div>
        <div>
            <strong>###PAGAMENTO DE CONVÊNIO - CELPE###</strong>
        </div>
        <div>
            <div class="form-group">
                <label>Código de Barras</label>
                <input style="width: 100%;" type="text" name="codigoBarrasCelpe">
            </div>
        </div>
        <div>
            <button type="submit">LER</button>
        </div>
    </div>
</form>