<?php 
include_once '/Model/Config/config.php';
include_once 'Model/pedido_model.php';
class pedidoController extends Conexion
{
	public function ListaDatos()
	{
		//$datopedido=array();
		//$consulta="SELECT ped.id_pedido,per.Persona_id_persona,ped.vendedor,ped.fecha_pedido,ped.fecha_vencimiento,ped.despachado_por,ped.estado FROM pedido ped INNER JOIN persona per ON per.id_persona = per.Persona_id_persona  ORDER BY id_pedido ";

         $datopedido=array();
		 $consulta="SELECT * FROM tbl_pedido ORDER BY id_pedido ";
		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$pedido = new Pedido();
				$pedido->__SET('id_pedido',$datos->id_pedido);
				$pedido->__SET('Persona_id_persona',$datos->Persona_id_persona);
				$pedido->__SET('vendedor',$datos->vendedor);
				$pedido->__SET('fecha_pedido',$datos->fecha_pedido);
				$pedido->__SET('fecha_vencimiento',$datos->fecha_vencimiento);
				$pedido->__SET('despachado_por',$datos->despachado_por);
				$pedido->__SET('estado',$datos->estado);
				$datopedido[]=$pedido;
			}
			return $datopedido;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function insertar(Pedido $pedido)
	{
		$insertar="INSERT INTO tbl_pedido (Persona_id_persona,vendedor,fecha_pedido,fecha_vencimiento,despachado_por,estado) values (?,?,?,?,?,?)";
		try {
			$this->conexion->prepare($insertar)->execute(array(
				$pedido->__GET('Persona_id_persona'),
				$pedido->__GET('vendedor'),
				$pedido->__GET('fecha_pedido'),
				$pedido->__GET('fecha_vencimiento'),
				$pedido->__GET('despachado_por'),
				$pedido->__GET('estado'),
				));

			return true;
		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}
	public function buscar($id_pedido)
	{
		$buscar="SELECT * FROM tbl_pedido where id_pedido=?";
		try {
			$resultado=$this->conexion->prepare($buscar);
			$resultado->execute(array($id_pedido));
			$datos=$resultado->fetch(PDO::FETCH_OBJ);
			$pedido= new Pedido();
			$pedido->__SET('id_pedido',$datos->id_pedido);
			$pedido->__SET('Persona_id_persona',$datos->Persona_id_persona);
			$pedido->__SET('vendedor',$datos->vendedor);
			$pedido->__SET('fecha_pedido',$datos->fecha_pedido);
			$pedido->__SET('fecha_vencimiento',$datos->fecha_vencimiento);
			$pedido->__SET('despachado_por',$datos->despachado_por);
			$pedido->__SET('estado',$datos->estado);
			return $pedido;
		} catch (Exception $e) {
			echo "error al buscar ".$e->getMessage();
		}
	}
	public function actualizar(Pedido $pedido)
	{
		$actualizar="UPDATE tbl_pedido SET Persona_id_persona=?,vendedor=?,fecha_pedido=?,fecha_vencimiento=?,despachado_por=?,estado=? where id_pedido=? ";
		try {
			$this->conexion->prepare($actualizar)->execute(array(
				$pedido->__GET('Persona_id_persona'),
				$pedido->__GET('vendedor'),
				$pedido->__GET('fecha_pedido'),
				$pedido->__GET('fecha_vencimiento'),
				$pedido->__GET('despachado_por'),
				$pedido->__GET('estado'),
				$pedido->__GET('id_pedido')

				));
			return true;

		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}
	public function eliminar($id_pedido)
	{
		$borrar="DELETE  FROM tbl_pedido WHERE id_pedido=?";
		try {
			$this->conexion->prepare($borrar)->execute(array($id_pedido));
			return true;

		} catch (Exception $e) {
			echo "error al eliminar datos ".$e->getMessage();
		}
	}



}



?>