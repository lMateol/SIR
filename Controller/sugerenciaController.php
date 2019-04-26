<?php 
include_once 'Model/sugerenciaModel.php';
class comentarioController
{
	public function insertar(comentarioModel $categoria)
	{
		$comentarioModel = new comentarioModel();
		
		return $comentarioModel->insertar($categoria);
	}

	public function ListaDatos()
	{
		$comentarioModel = new comentarioModel();
		
		return $comentarioModel->ListaDatos();
	}

	public function buscar($id_comentario)
	{
		$comentarioModel = new comentarioModel();
		
		return $comentarioModel->buscar($id_Categoria);
	}


	public function eliminar($id_comentario)
	{
		$comentarioModel = new comentarioModel();
		
		return $comentarioModel->eliminar($id_comentario);
	}
}



?>