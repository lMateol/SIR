<?php 
include_once './Model/config.php';
include_once './Model/user_model.php';
class User_Controller extends conexion
{
	public function ListaDatos()
	{
		$datousuario=array();
		$consulta="SELECT * FROM tbl_usuario ORDER BY id_usuario ";
		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$usuario = new Usuario();
				$usuario->__SET('id_usuario',$datos->id_usuario);
				$usuario->__SET('nombre',$datos->nombre);
				$usuario->__SET('correo',$datos->correo);
				$usuario->__SET('password',$datos->password);
				$datousuario[]=$usuario;
			}
			return $datousuario;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function insertar(Usuario $usuario)
	{
		$insertar="INSERT INTO tbl_usuario (nombre,correo,password) values (?,?,?)";
		try {
			$this->conexion->prepare($insertar)->execute(array(
				$usuario->__GET('nombre'),
				$usuario->__GET('correo'),
				$usuario->__GET('password')
				));

			return true;
		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}
	public function buscar($id_usuario)
	{
		$buscar="SELECT * FROM tbl_usuario where id_usuario=1";
		try {
			$resultado=$this->conexion->prepare($buscar);
			$resultado->execute(array($id_usuario));
			$datos=$resultado->fetch(PDO::FETCH_OBJ);
			$usuario= new Usuario();
			$usuario->__SET('id_usuario',$datos->id_usuario);
			$usuario->__SET('nombre',$datos->nombre);
			$usuario->__SET('correo',$datos->correo);
			$usuario->__SET('password',$datos->password);
			return $usuario;
		} catch (Exception $e) {
			echo "error al buscar ".$e->getMessage();
		}
	}
	public function actualizar(Usuario $usuario)
	{
		$actualizar="UPDATE tbl_usuario SET nombre=?,correo=? where id_usuario=1 ";
		try {
			$this->conexion->prepare($actualizar)->execute(array(
				$usuario->__GET('nombre'),
				$usuario->__GET('correo')
			

				));
			return true;

		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}

	public function actualizar1(Usuario $usuario)
	{
		$actualizar="UPDATE tbl_usuario SET password=? where id_usuario=1 ";
		try {
			$this->conexion->prepare($actualizar)->execute(array(
				$usuario->__GET('password')
			

				));
			return true;

		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}

	public function eliminar($id_usuario)
	{
		$borrar="DELETE  FROM tbl_usuario WHERE id_usuario=?";
		try {
			$this->conexion->prepare($borrar)->execute(array($id_usuario));
			return true;

		} catch (Exception $e) {
			echo "error al eliminar datos ".$e->getMessage();
		}
	}




















}



?>