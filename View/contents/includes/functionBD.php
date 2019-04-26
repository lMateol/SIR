<?php 
class GestarBD{
	private $conect;  
	private $base_datos;
	private $servidor;
	private $usuario;
	private $pass;
	private $response;


	function __construct()
	{
		include 'View/contents/includes/config1.php';
		$this->servidor = $config['servidor'];
		$this->usuario = $config['usuario'];
		$this->pass = $config['pass'];
		$this->base_datos = $config['basedatos'];
		$this->conectar_base_datos();
	}

	private function conectar_base_datos() {
	 	//$this->conect = mysqli_connect($this->Servidor,$this->Usuario,$this->Clave);
		//mysqli_select_db($this->BaseDatos,$this->conect);
		
		if (! $this->conect = new mysqli($this->servidor,$this->usuario,$this->pass,$this->base_datos)) {
				# code...
				echo "Error al conectar";
				exit();
			}

				$this->conect->set_charset('utf8');
				return false;	
	}
	public function consulta($consulta)
	{
		# code...		
		$this->response = $this->conect->query($consulta);
		return $this->response;
	}



	public function mostrar_registros($resultado=NULL)
	{
		
		# code...
		if ($resultado!=null) {
			# code...
			return $resultado->fetch_object();
		} else {
			if ($this->response!=null) {
				# code...
				return $this->response->fetch_object();
			} else {
				
				return false;
			}
		}
	}
	
	public function SelectText($campos,$tabla,$where,$order,$datoOrder,$tipoOrder)
	{
		# code...
		$select = "SELECT $campos FROM $tabla ";
		if ($where == true) {
			# code...
			$select .= "WHERE $where";
		}
		if ($order == true) {
			$select .= "ORDER BY $datoOrder $tipoOrder";
		}		
		return $select;
	}
	
}