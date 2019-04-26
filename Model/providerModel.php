<?php
	class personModel
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
	}
?>