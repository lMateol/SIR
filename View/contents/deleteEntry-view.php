<?php 
	require_once "Controller/entryController.php";
$control = new entryController();
if ($control->eliminar($_GET['id'])) {
	echo "Datos eliminandos con exito  "; ?>
	<meta http-equiv="refresh" content="0; url=list-entry.php">
<?php  }?>