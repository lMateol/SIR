<?php
include_once 'Model/config.php';

	class CategoriaModel extends conexion
	{
	//declaracion de atributos o variables
	private $id_Categoria;
	private $categoria;
	private $estado;

	//encapsulamiento
	public function __GET($atr)
	{
		return $this->$atr;
	}

	public function __SET($atr, $vl)
	{
		$this->$atr=$vl;
	}

	//realizamos la insercion a la bd con el parametro tipo CategoriaModel
	public function insertar(CategoriaModel $categoria)	
	{
		//consulta
		$insertar="INSERT INTO tbl_categoria_producto (categoria, estado) values (?,?)";
		try {
			//conectamos y ejecutamos la consulta con sus respectivos parametros
			$this->conexion->prepare($insertar)->execute(array(
				$categoria->__GET('categoria'),
				$categoria->__GET('estado')
				));

			return true;
		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}
	// consultamos todas las categorias en la bd
	public function ListaDatos()
	{
		//declaramos el array en el que devolveremos los objetos categoriaModel(las categorias) llenos
		$datocategoria=array();
		// declaramos consulta
		$consulta="SELECT * FROM tbl_categoria_producto ORDER BY id_categoria ";
		try {
			//reparamos la consulta con la conexion
			$resultado=$this->conexion->prepare($consulta);
			//ejecutamos y almacenamos lo que trae en la variable "resultado"
			$resultado->execute();
			//convertimos ese resultado en un array asociativo y lo recorremos para traer las categorias
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				//instanciamos y llemanos objetos de categoria (llenamos las categorias que metemos en el array)
				$categoria = new CategoriaModel();
				$categoria->__SET('id_Categoria',$datos->id_Categoria);
				$categoria->__SET('categoria',$datos->categoria);
				$categoria->__SET('estado',$datos->estado);
				//asignamos cada categoria en una posicion del array
				$datocategoria[]=$categoria;
			}
			return $datocategoria;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	//buscamos una categoria de acuerdo a el id de esta
	public function buscar($id_Categoria)
	{
		// declaramos consulta
		$buscar="SELECT * FROM tbl_categoria_producto where id_Categoria=?";
		try {
			//reparamos la consulta con la conexion
			$resultado=$this->conexion->prepare($buscar);
			//ejecutamos y almacenamos lo que trae en la variable "resultado"
			$resultado->execute(array($id_Categoria));
			//convertimos ese resultado en un array asociativo para traer la categoria y no es necesario recorrerlo porque solo trae un dato
			$datos=$resultado->fetch(PDO::FETCH_OBJ);
				//instanciamos y llemanos objetos de categoria (llenamos la categorias)
			$categoria= new CategoriaModel();
			$categoria->__SET('id_Categoria',$datos->id_Categoria);
			$categoria->__SET('categoria',$datos->categoria);
			$categoria->__SET('estado',$datos->estado);
				//retornamos la categoria con sus datos
			return $categoria;
		} catch (Exception $e) {
			echo "error al buscar ".$e->getMessage();
		}
	}
	//actualizamos una categoria de acuerdo a un id
	public function actualizar(CategoriaModel $categoria)
	{
		// declaramos consulta
		$actualizar="UPDATE tbl_categoria_producto SET categoria=?, estado=? where id_Categoria=? ";
		try {
			//ejecutamos con la conexion y almacenamos lo que trae en la variable "resultado"
			$this->conexion->prepare($actualizar)->execute(array(
				$categoria->__GET('categoria'),
				$categoria->__GET('estado'),
				$categoria->__GET('id_Categoria')
				));
			return true;

		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}
	//cambiamos el estado de una categoria
	public function eliminar($id_Categoria)
	{
		// declaramos consulta
		$borrar="DELETE  FROM tbl_categoria_producto WHERE id_Categoria=?";
		try {
			//ejecutamos con la conexion y almacenamos lo que trae en la variable "resultado"
			$this->conexion->prepare($borrar)->execute(array($id_Categoria));
			return true;

		} catch (Exception $e) {
			echo "error al eliminar datos ".$e->getMessage();
		}
	}
}

?>