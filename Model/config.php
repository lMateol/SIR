<?php
	class conexion
	{
		private $servername = "localhost";
		private $username = "root";
		private $password = "";
		protected $conexion;

		public function __CONSTRUCT()
		{
		try {
		    $this->conexion = new PDO("mysql:host=$this->servername;dbname=s.i.r", $this->username, $this->password);
		    // set the PDO error mode to exception
		    $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    // echo "Connected successfully"; 
		    }catch(PDOException $e){
		    echo "Connection failed: " . $e->getMessage();
    }
		}
	}
?>