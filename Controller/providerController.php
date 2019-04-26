<?php

include_once "Model/Config.php";
include_once "Model/providerModel.php";
	class personController extends conexion
	{
		public function listar()
		{
			$datosPerson = array();
			// $consultar = "SELECT * FROM persona ORDER BY id_persona";
			$consultar = "SELECT per.id_persona, per.nombres, per.apellidos, doc.nombre_documento, per.documento, per.telefono, per.nro_Celular, per.direccion, per.ciudad, per.departamento, tper.nombre_tipo, CASE WHEN per.estado = 1 THEN 'Activo' ELSE 'Inactivo' END AS estado FROM persona per INNER JOIN tipo_documento doc ON per.tipo_documento_tipo_documento = doc.tipo_documento INNER JOIN tipo_persona tper ON per.tipo_persona_tipo_persona = tper.tipo_persona ORDER BY id_persona";
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
					$usuario->__SET('estado', $dato->estado);

					$datosPerson[] = $usuario;
				}
				return $datosPerson;
			}catch(Exception $e){
				echo "Error al consultar".$e->getMessage();
			}
		}
		public function insertar(personModel $usuario)
		{
			$insertar = "INSERT INTO persona (id_persona, nombres, apellidos, tipo_documento_tipo_documento, documento, telefono, nro_Celular, direccion, ciudad, departamento, tipo_persona_tipo_persona, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			try{
				$this->conexion->prepare($insertar)->execute(array(
					$usuario->__GET('id_persona'),
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
		public function buscar($id)
		{
			$buscar  = "SELECT * FROM persona WHERE id_persona=?";
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
			$insertar = "UPDATE persona SET nombres=?, apellidos=?, tipo_documento_tipo_documento=?, documento=?, telefono=?, nro_Celular=?, direccion=?, ciudad=?, departamento=?, tipo_persona_tipo_persona=?, estado=? WHERE id_persona=?";
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
			$borrar = "DELETE FROM persona WHERE id_persona=?";
			try{
				$this->conexion->prepare($borrar)->execute(array($id));
				return true;
			}catch (Exception $e){
				echo "Error al eliminar datos ".$e->getMessage();
			}
		}
	}
?>