<?php 
require_once 'Controller/productController.php';
$productoController = new productoController();
if ($productoController->eliminar($_GET['id_producto'])) {
	echo "Datos eliminandos con exito  "; ?>
	<meta http-equiv="refresh" content="0; url=list-product.php">
<?php  }?>