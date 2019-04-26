<?php 
if (isset($_REQUEST['estado']) && isset($_REQUEST['id'])) {
	$estado = (1 == $_REQUEST['estado']) ? 0 : 1;
	$idProducto = $_REQUEST['id'];
	var_dump($estado . $idProducto);
	try {
		    $con = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
		    // set the PDO error mode to exception
		    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// echo "Connected successfully"; 
				$con->prepare("UPDATE `tbl_producto` SET `estado`=? WHERE id_producto=?")->execute(array(
					$estado,
					$idProducto
				));
		    }catch(PDOException $e){
		    echo "Connection failed: " . $e->getMessage();
    }
}else {
include_once 'Model/productModel.php';
include_once 'Model/categoryModel.php';

class productoController
{

	public function insertar(productoModel $producto)
  	{
		$productoModel = new productoModel();
		return $productoModel->insertar($producto);
	}

	public function listar()
	{
		$productoModel = new productoModel();
		return $productoModel->listar();
	}
	
	public function buscar($id_producto)
	{
		$productoModel = new productoModel();
		return $productoModel->buscar($id_producto);
	}

	public function actualizar(productoModel $producto)
	{
		$productoModel = new productoModel();
		return $productoModel->actualizar($producto);
	}

	public function eliminar($id_producto)
	{
		$productoModel = new productoModel();
		return $productoModel->eliminar($id_producto);
	}
}
}