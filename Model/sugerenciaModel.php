<?php
include_once 'Model/config.php';

	class comentarioModel extends conexion
	{
	//declaracion de atributos o variables
	private $id_comentario;
	private $nombre;
	private $correo;
	private $telefono;
	private $comentario;
	private $fecha;

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
	public function insertar(comentarioModel $categoria)	
	{
		//consulta
		$insertar="INSERT INTO tbl_comentario(nombre, correo, telefono, comentario, fecha) values (?,?,?,?,?)";
		try {
			//conectamos y ejecutamos la consulta con sus respectivos parametros
			$this->conexion->prepare($insertar)->execute(array(
				$categoria->__GET('nombre'),
				$categoria->__GET('correo'),
				$categoria->__GET('telefono'),
				$categoria->__GET('comentario'),
				$categoria->__GET('fecha')
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
		$consulta="SELECT * FROM tbl_comentario ORDER BY id_comentario";
		try {
			//reparamos la consulta con la conexion
			$resultado=$this->conexion->prepare($consulta);
			//ejecutamos y almacenamos lo que trae en la variable "resultado"
			$resultado->execute();
			//convertimos ese resultado en un array asociativo y lo recorremos para traer las categorias
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				//instanciamos y llemanos objetos de categoria (llenamos las categorias que metemos en el array)
				$categoria = new comentarioModel();
				$categoria->__SET('id_comentario',$datos->id_comentario);
				$categoria->__SET('nombre',$datos->nombre);
				$categoria->__SET('telefono',$datos->telefono);
				$categoria->__SET('correo',$datos->correo);
				$categoria->__SET('comentario',$datos->comentario);
				$categoria->__SET('fecha',$datos->fecha);
				//asignamos cada categoria en una posicion del array
				$datocategoria[]=$categoria;
			}
			return $datocategoria;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	//buscamos una categoria de acuerdo a el id de esta
	public function buscar($id_comentario)
	{
		// declaramos consulta
		$buscar="SELECT * FROM tbl_comentario where id_comentario=?";
		try {
			//reparamos la consulta con la conexion
			$resultado=$this->conexion->prepare($buscar);
			//ejecutamos y almacenamos lo que trae en la variable "resultado"
			$resultado->execute(array($id_Categoria));
			//convertimos ese resultado en un array asociativo para traer la categoria y no es necesario recorrerlo porque solo trae un dato
			$datos=$resultado->fetch(PDO::FETCH_OBJ);
				//instanciamos y llemanos objetos de categoria (llenamos la categorias)
			$categoria= new comentarioModel();
			$categoria->__SET('id_comentario',$datos->id_comentario);
			$categoria->__SET('nombre',$datos->nombre);
			$categoria->__SET('correo',$datos->correo);
			$categoria->__SET('telefono',$datos->telefono);
			$categoria->__SET('comentario',$datos->comentario);
			$categoria->__SET('fecha',$datos->fecha);
				//retornamos la categoria con sus datos
			return $categoria;
		} catch (Exception $e) {
			echo "error al buscar ".$e->getMessage();
		}
	}
	//actualizamos una categoria de acuerdo a un id
	//cambiamos el estado de una categoria
	public function eliminar($id_comentario)
	{
		// declaramos consulta
		$borrar="DELETE  FROM tbl_comentario WHERE id_comentario=?";
		try {
			//ejecutamos con la conexion y almacenamos lo que trae en la variable "resultado"
			$this->conexion->prepare($borrar)->execute(array($id_comentario));
			return true;

		} catch (Exception $e) {
			echo "error al eliminar datos ".$e->getMessage();
		}
	}
}

?>