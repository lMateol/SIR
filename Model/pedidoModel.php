<?php 
class PedidoModel
{
	private $id_pedido;
	private $Persona_id_persona;
	private $vendedor;
	private $fecha_pedido;
	private $fecha_vencimiento;
	private $despachado_por;
	private $estado;
	
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