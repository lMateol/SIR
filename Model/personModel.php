<?php
include_once "Model/config.php";
include_once "Model/tipoDocumento_Persona_model.php";

	class personModel extends conexion
	{
		private $id_persona;
		private $nombres;
		private $apellidos;
		private $tipo_documento_tipo_documento;
		private $documento;
		private $telefono;
		private $nro_Celular;
		private $direccion;
		private $ciudad;
		private $departamento;
		private $tipo_persona_tipo_persona;
		private $numEstado;
		private $estado;
		private $tipo_persona;
		private $tipo_documento;


		public function __GET($atr)
		{
			return $this->$atr;
		}
		public function __SET($atr, $vl)
		{
			$this->$atr=$vl;
		}
		
		public function insertar(personModel $usuario)
		{
			$insertar = "INSERT INTO tbl_persona (nombres, apellidos, tipo_documento_tipo_documento, documento, telefono, nro_Celular, direccion, ciudad, departamento, tipo_persona_tipo_persona, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			try{
				$this->conexion->prepare($insertar)->execute(array(
					$usuario->__GET('nombres'),
					$usuario->__GET('apellidos'),
					$usuario->__GET('tipo_documento_tipo_documento'),
					$usuario->__GET('documento'),
					$usuario->__GET('telefono'),
					$usuario->__GET('nro_Celular'),
					$usuario->__GET('direccion'),
					$usuario->__GET('ciudad'),
					$usuario->__GET('departamento'),
					$usuario->__GET('tipo_persona_tipo_persona'),
					$usuario->__GET('estado')
				));
				return true;
			}catch (Exception $e){
				echo "Error al isertar datos: ".$e->getMessage();
			}
		}

		public function listar()
		{
			$datosPerson = array();
			// $consultar = "SELECT * FROM persona ORDER BY id_persona";
			$consultar = "SELECT per.estado as numEstado, per.id_persona, per.nombres, per.apellidos, doc.nombre_documento, per.documento, per.telefono, per.nro_Celular, per.direccion, per.ciudad, per.departamento, tper.nombre_tipo, CASE WHEN per.estado = 1 THEN 'Activo' ELSE 'Inactivo' END AS estado FROM tbl_persona per INNER JOIN tbl_tipo_documento doc ON per.tipo_documento_tipo_documento = doc.tipo_documento INNER JOIN tbl_tipo_persona tper ON per.tipo_persona_tipo_persona = tper.tipo_persona ORDER BY id_persona";
			try{
				$resultado = $this->conexion->query($consultar);
				// $resultado = execute();

				foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $dato) {
					$usuario = new personModel();
					$usuario->__SET('id_persona', $dato->id_persona);
					$usuario->__SET('nombres', $dato->nombres);
					$usuario->__SET('apellidos', $dato->apellidos);
					$usuario->__SET('nombre_documento', $dato->nombre_documento);
					$usuario->__SET('documento', $dato->documento);
					$usuario->__SET('telefono', $dato->telefono);
					$usuario->__SET('nro_Celular', $dato->nro_Celular);
					$usuario->__SET('direccion', $dato->direccion);
					$usuario->__SET('ciudad', $dato->ciudad);
					$usuario->__SET('departamento', $dato->departamento);
					$usuario->__SET('nombre_tipo', $dato->nombre_tipo);
					$usuario->__SET('numEstado', $dato->numEstado);
					$usuario->__SET('estado', $dato->estado);

					$datosPerson[] = $usuario;
				}
				return $datosPerson;
			}catch(Exception $e){
				echo "Error al consultar".$e->getMessage();
			}
		}

		public function buscar($id)
		{
			$buscar  = "SELECT * FROM tbl_persona WHERE id_persona=?";
			try{
				$resultado = $this->conexion->prepare($buscar);
				$resultado->execute(array($id));

				$datos = $resultado->fetch(PDO::FETCH_OBJ);
				$usuario = new personModel();
				$usuario->__SET('id_persona', $datos->id_persona);
				$usuario->__SET('nombres', $datos->nombres);
				$usuario->__SET('apellidos', $datos->apellidos);
				$usuario->__SET('tipo_documento_tipo_documento', $datos->tipo_documento_tipo_documento);
				$usuario->__SET('documento', $datos->documento);
				$usuario->__SET('telefono', $datos->telefono);
				$usuario->__SET('nro_Celular', $datos->nro_Celular);
				$usuario->__SET('direccion', $datos->direccion);
				$usuario->__SET('ciudad', $datos->ciudad);
				$usuario->__SET('departamento', $datos->departamento);
				$usuario->__SET('tipo_persona_tipo_persona', $datos->tipo_persona_tipo_persona);
				$usuario->__SET('estado', $datos->estado);	

				return $usuario;
			}catch (Exception $e){
				echo "Error al buscar datos ".$e->getMessage();
			}
		}

		public function actualizar(personModel $usuario)
		{
			$insertar = "UPDATE tbl_persona SET nombres=?, apellidos=?, tipo_documento_tipo_documento=?, documento=?, telefono=?, nro_Celular=?, direccion=?, ciudad=?, departamento=?, tipo_persona_tipo_persona=?, estado=? WHERE id_persona=?";
			try{
				$this->conexion->prepare($insertar)->execute(array(
					$usuario->__GET('nombres'),
					$usuario->__GET('apellidos'),
					$usuario->__GET('tipo_documento_tipo_documento'),
					$usuario->__GET('documento'),
					$usuario->__GET('telefono'),
					$usuario->__GET('nro_Celular'),
					$usuario->__GET('direccion'),
					$usuario->__GET('ciudad'),
					$usuario->__GET('departamento'),
					$usuario->__GET('tipo_persona_tipo_persona'),
					$usuario->__GET('estado'),
					$usuario->__GET('id_persona')
				));
				return true;
			}catch (Exception $e){
				echo "Error al buscar datos ".$e->getMessage();
			}
		}

		public function eliminar($id)
		{
			$borrar = "DELETE FROM tbl_persona WHERE id_persona=?";
			try{
				$this->conexion->prepare($borrar)->execute(array($id));
				return true;
			}catch (Exception $e){
				echo "Error al eliminar datos ".$e->getMessage();
			}
			// include_once '../model/config.php';
		 //    $id=$_GET["id"];
		 //    $sql="DELETE FROM persona WHERE id_persona=:id_persona";
		 //    $sentencia=$this->conexion->prepare($sql);	
		 //    //$sentencia->bindparam(':id',$id);
		 //    //$sentencia->execute();
		 //    $sentencia->execute(array(':id_persona' =>$id));
		 //    echo "<br><font color='green'>Datos eliminados con exitos.<br>";
		 //    echo '<a href="http:index.php">HOME</a>';
		}
	}
?>