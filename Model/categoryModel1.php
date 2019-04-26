<?php

	class CategoriaModel1
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

}
