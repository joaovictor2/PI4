<?php
ob_start();

?>

<div id="formulario">
	<?php include "formulario.php"; ?>
</div>

<?php

$conteudo = ob_get_contents();
ob_end_clean();
$titulo = "Formulário";
include "../layout.php";

?>