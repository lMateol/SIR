<?php

include_once "Model/entryModel.php";
	class entryController 
	{
		public function listar()
		{
			$entradaModel = new entryModel();
			return $entradaModel->listar();
		}
		public function insertar(entryModel $entrada)
		{
			$entradaModel = new entryModel();
			return $entradaModel->insertar($entrada);
		}
		public function buscar($id)
		{
			$entradaModel = new entryModel();
			return $entradaModel->buscar($id);
		}
		public function actualizar(entryModel $entrada)
		{
			$entradaModel = new entryModel();
			return $entradaModel->actualizar($entrada);
		}

		public function eliminar($id)
		{
			$entradaModel = new entryModel();
			return $entradaModel->eliminar($id);
		}
	}
?>