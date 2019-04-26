<?php 

class Usuario 
{
	private $id_usuario;
	private $nombre;
	private $correo;
	private $password;
	


	public function __GET($att)
	{
		return $this->$att;
	}

	public function __SET($att, $v)
	{
		$this->$att=$v;
	}
}




?>