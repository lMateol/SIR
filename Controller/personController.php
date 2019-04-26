<?php
if (isset($_REQUEST['estado']) && isset($_REQUEST['id'])) {
	$estado = (1 == $_REQUEST['estado']) ? 0 : 1;
	$idPersona = $_REQUEST['id'];
	var_dump($estado . $idPersona);
	try {
		    $con = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
		    // set the PDO error mode to exception
		    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// echo "Connected successfully"; 
				$con->prepare("UPDATE `tbl_persona` SET `estado`=? WHERE id_persona=?")->execute(array(
					$estado,
					$idPersona
				));
				echo "datos registrados";
		    }catch(PDOException $e){
		    echo "Connection failed: " . $e->getMessage();
    }
}else {
include_once "Model/personModel.php";
class personController 
{
	public function consultarTipoDocumento()
	{
		$personModel = new personModel();
		return $personModel->consultarTipoDocumento();
	}

	public function consultarTipoPersona()
	{
		$personModel = new personModel();
		return $personModel->consultarTipoPersona();
	}

	public function insertar(personModel $usuario)
	{
		$personModel = new personModel();
		return $personModel->insertar($usuario);
	}
	
	public function listar()
	{
		$personModel = new personModel();
		return $personModel->listar();
	}
	
	public function buscar($id)
	{
		$personModel = new personModel();
		return $personModel->buscar($id);
	}

	public function actualizar(personModel $usuario)
	{
		$personModel = new personModel();
		return $personModel->actualizar($usuario);
	}

	public function eliminar($id)
	{
		$personModel = new personModel();
		return $personModel->eliminar($id);
	}
}
}

?>