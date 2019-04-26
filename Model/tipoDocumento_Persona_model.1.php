<?php
	class tipoDocumentoPersonModel1 
	{
	//declaracion de atributos o variables
	private $tipo_documento;
	private $tipo_persona;
	private $nombre_documento;
	private $nombre_tipo;
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

?>