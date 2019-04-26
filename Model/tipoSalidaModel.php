<?php

	class tipoSalidaModel extends conexion
	{
	//declaracion de atributos o variables
	private $tipo_salida;
	private $nombre;
	//encapsulamiento
	public function __GET($atr)
	{
		return $this->$atr;
	}

	public function __SET($atr, $vl)
	{
		$this->$atr=$vl;
	}

	public function consultarTipoSalida()
		{
			$tipoSalida = array();
			$consultar = "SELECT * FROM tbl_tipo_salida";
			try{
				$resultado = $this->conexion->query($consultar);

				foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $dato) {
					$tipo = new tipoSalidaModel();
					$tipo->__SET('tipo_salida', $dato->tipo_salida);
					$tipo->__SET('nombre', $dato->nombre);
					$tipoSalida[] = $tipo;
				}
				return $tipoSalida;
			}catch(Exception $e){
				echo "Error al consultar".$e->getMessage();
			}
		}

	public function consultarTipoPersona()
	{
		$tipoPersona = array();
		$consultar = "SELECT * FROM tbl_tipo_persona";
		try{
			$resultado = $this->conexion->query($consultar);
			
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $dato) {
				$tipo = new tipoSalidaModel();
				$tipo->__SET('tipo_persona', $dato->tipo_persona);
				$tipo->__SET('nombre_tipo', $dato->nombre_tipo);
				$tipoPersona[]=$tipo;
			}
			
			return $tipoPersona;
		}catch(Exception $e){
			echo "Error al consultar".$e->getMessage();
		}
	}
	
	public function consultarTipoPersonaById($id)
	{
		$tipoPersona = array();
		$consultar = "SELECT * FROM tbl_tipo_persona WHERE tipo_persona=$id";
		try{
			$resultado = $this->conexion->query($consultar);


			$dato=$resultado->fetch(PDO::FETCH_OBJ);

			$tipo = new tipoSalidaModel();

			$tipo->__SET('tipo_persona', $dato->tipo_persona);
			$tipo->__SET('nombre_tipo', $dato->nombre_tipo);

			return $tipo;
		}catch(Exception $e){
			echo "Error al consultar".$e->getMessage();
		}
	}

}

?>