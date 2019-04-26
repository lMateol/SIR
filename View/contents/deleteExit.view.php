<?php 
	require_once "Controller/exitController.php";
$control = new exitController();
if ($control->eliminar($_GET['id'])) {
	echo "Datos eliminandos con exito  "; ?>
	<meta http-equiv="refresh" content="0; url=list-exit.php">
<?php  }?>