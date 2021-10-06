<?php
$this->data["empresa"] = NOME_EMPRESA;
$this->layout("_theme", $this->data); 
echo "###SELECIONE UMA OPÇÃO ABAIXO###<br/>";
echo "
	<a href='/celpe'>1 - CELPE</a><br/>
	<a href=''>2 - COMPESA</a><br/>
	<a href=''>3 - BOLETOS</a><br/>
";
?>