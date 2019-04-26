<?php

include_once "Model/exitModel.php";
	class exitController 
	{
		public function listar()
		{
			$salidaModel = new exitModel();
			return $salidaModel->listar();
		}
		public function insertar(exitModel $salida)
		{
			$salidaModel = new exitModel();
			return $salidaModel->insertar($salida);
		}
		public function buscar($id)
		{
			$salidaModel = new exitModel();
			return $salidaModel->buscar($id);
		}
		public function actualizar(exitModel $salida)
		{
			$salidaModel = new exitModel();
			return $salidaModel->actualizar($salida);
		}

		public function eliminar($id)
		{
			$salidaModel = new exitModel();
			return $salidaModel->eliminar($id);
		}
	}
?>