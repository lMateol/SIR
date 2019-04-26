<?php 
include_once 'Model/configuracion.php';
include_once 'Model/pedidoDetalleModel.php';
class Pedido_Detalle_Controller extends Conexion
{
	public function ListaDatos()
	{
		$datopedido=array();
		$consulta="SELECT * FROM pedido_has_producto ORDER BY Pedido_has_Producto ";
		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$pedido = new PedidoDetalle();
				$pedido->__SET('Pedido_has_Producto',$datos->Pedido_has_Producto);
				$pedido->__SET('Pedido_id_pedido',$datos->Pedido_id_pedido);
				$pedido->__SET('Producto_id_producto',$datos->Producto_id_producto);
				$pedido->__SET('cantidad',$datos->cantidad);
				$pedido->__SET('precio',$datos->precio);
				$pedido->__SET('sub_total1',$datos->sub_total1);
				$pedido->__SET('descuento',$datos->descuento);
				$pedido->__SET('sub_total2',$datos->sub_total2);
				$pedido->__SET('iva_total',$datos->iva_total);
				$pedido->__SET('total_pagar',$datos->total_pagar);
				$datopedido[]=$pedido;
			}
			return $datopedido;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function insertar(PedidoDetalle $pedido)
	{
		$insertar="INSERT INTO pedido_has_producto (Pedido_id_pedido,Producto_id_producto,cantidad,precio,sub_total1,descuento,sub_total2,iva_total,total_pagar) values (?,?,?,?,?,?,?,?,?)";
		try {
			$this->conexion->prepare($insertar)->execute(array(
				$pedido->__GET('Pedido_id_pedido'),
				$pedido->__GET('Producto_id_producto'),
				$pedido->__GET('cantidad'),
				$pedido->__GET('precio'),
				$pedido->__GET('sub_total1'),
				$pedido->__GET('descuento'),
				$pedido->__GET('sub_total2'),
				$pedido->__GET('iva_total'),
				$pedido->__GET('total_pagar'),
				));

			return true;
		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}
	public function buscar($Pedido_has_Producto)
	{
		$buscar="SELECT * FROM pedido_has_producto where Pedido_has_Producto=?";
		try {
			$resultado=$this->conexion->prepare($buscar);
			$resultado->execute(array($Pedido_has_Producto));
			$datos=$resultado->fetch(PDO::FETCH_OBJ);
			$pedido = new PedidoDetalle();
				$pedido->__SET('Pedido_has_Producto',$datos->Pedido_has_Producto);
				$pedido->__SET('Pedido_id_pedido',$datos->Pedido_id_pedido);
				$pedido->__SET('Producto_id_producto',$datos->Producto_id_producto);
				$pedido->__SET('cantidad',$datos->cantidad);
				$pedido->__SET('precio',$datos->precio);
				$pedido->__SET('sub_total1',$datos->sub_total1);
				$pedido->__SET('descuento',$datos->descuento);
				$pedido->__SET('sub_total2',$datos->sub_total2);
				$pedido->__SET('iva_total',$datos->iva_total);
				$pedido->__SET('total_pagar',$datos->total_pagar);
			return $pedido;
		} catch (Exception $e) {
			echo "error al buscar ".$e->getMessage();
		}
	}
	public function actualizar(PedidoDetalle $pedido)
	{
		$actualizar="UPDATE pedido_has_producto SET Pedido_id_pedido=?,Producto_id_producto=?,cantidad=?,precio=?,sub_total1=?,descuento=?,sub_total2=?,iva_total=?,total_pagar=? where Pedido_has_Producto=? ";
		try {
			$this->conexion->prepare($actualizar)->execute(array(
				$pedido->__GET('Pedido_id_pedido'),
				$pedido->__GET('Producto_id_producto'),
				$pedido->__GET('cantidad'),
				$pedido->__GET('precio'),
				$pedido->__GET('sub_total1'),
				$pedido->__GET('descuento'),
				$pedido->__GET('sub_total2'),
				$pedido->__GET('iva_total'),
				$pedido->__GET('total_pagar'),
				$pedido->__GET('Pedido_has_Producto')

				));
			return true;

		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}
	public function eliminar($Pedido_has_Producto)
	{
		$borrar="DELETE FROM pedido_has_producto WHERE Pedido_has_Producto=?";
		try {
			$this->conexion->prepare($borrar)->execute(array($Pedido_has_Producto));
			return true;

		} catch (Exception $e) {
			echo "error al eliminar datos ".$e->getMessage();
		}
	}




















}



?>