<?php
if (isset($_REQUEST['estado']) && isset($_REQUEST['id'])) {
	$estado = (1 == $_REQUEST['estado']) ? 0 : 1;
	$idCategoria = $_REQUEST['id'];
	var_dump($estado . $idCategoria);
	try {
		    $con = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
		    // set the PDO error mode to exception
		    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// echo "Connected successfully"; 
				$con->prepare("UPDATE `tbl_categoria_producto` SET `estado`=? WHERE id_Categoria=?")->execute(array(
					$estado,
					$idCategoria
				));
		    }catch(PDOException $e){
		    echo "Connection failed: " . $e->getMessage();
    }
}else {
include_once 'Model/categoryModel.php';
class CategoriaController
{
	public function insertar(CategoriaModel $categoria)
	{
		$categoriaModel = new CategoriaModel();
		
		return $categoriaModel->insertar($categoria);
	}

	public function ListaDatos()
	{
		$categoriaModel = new CategoriaModel();
		
		return $categoriaModel->ListaDatos();
	}

	public function buscar($id_Categoria)
	{
		$categoriaModel = new CategoriaModel();
		
		return $categoriaModel->buscar($id_Categoria);
	}

	public function actualizar(CategoriaModel $categoria)
	{
		$categoriaModel = new CategoriaModel();
		
		return $categoriaModel->actualizar($categoria);
	}

	public function eliminar($id_categoria)
	{
		$categoriaModel = new CategoriaModel();
		
		return $categoriaModel->eliminar($id_categoria);
	}
}

}

?>