<?php 
//incluimos la conexion a base de datos
include_once 'Model/config.php';
//------------------------------------
//iniciamos clase
class IniciarSesion extends conexion
{
	
	//metodo iniciar sesion---------------------------------------------------------------
	public function iniciar($correo,$pass)
	{	
		$usu=$correo;
		$password=hash('MD5',$pass); 
		//preparamos la  consulta  para  verificar si el rol del usuario es correto
		$iniciar="SELECT correo,nombre FROM tbl_usuario WHERE correo='$usu' AND password='$password' ";

		//-------------------------------------------------------------------------
		//validamos la consulta----------------------------------------------------
		try {
			$resul=$this->conexion->prepare($iniciar);
			$resul->execute();
			$dato=$resul->rowCount();

			if ($dato > 0) {
				$datos=$resul->fetch(PDO::FETCH_ASSOC);
				$_SESSION['usu']=$datos['correo'];
				$_SESSION['nombre']=$datos['nombre'];
						// header("location:home-view.php");
				return true;
			}else{
				echo "<script>alertify.error('No puedes iniciar sesion');</script>";
			}
			
		} catch (Exception $e) {
			//echo "error al ingresar datos ".$e->getMessage();
		}
	}
	//------------------------------------------------------------------------------------
}//finclase


?>










