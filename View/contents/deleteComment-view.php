<?php 
	require_once "../../Controller/sugerenciaController2.php";
$controls = new comentarioController();
if ($controls->eliminar($_GET['id'])) {
	echo "Datos eliminandos con exito  "; ?>
	<meta http-equiv="refresh" content="0; url=http://localhost:8080/SIR/listComment">
<?php  }?>