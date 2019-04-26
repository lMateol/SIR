<?php 

class PedidoDetalle
{
	private $Pedido_has_Producto;
	private $Pedido_id_pedido;
	private $Producto_id_producto;
	private $cantidad;
	private $precio;
	private $sub_total1;
	private $descuento;
	private $sub_total2;
	private $iva_total;
	private $total_pagar;
	


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