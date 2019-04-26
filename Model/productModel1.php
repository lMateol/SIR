<?php


class productoModel1 
{
		private $id_producto;
		private $referencia;
		private $nombre_producto;
    private $precio_unitario;
    private $IVA_Producto;
    private $Categoria_Producto_id_Categoria;
    private $Persona_id_persona;
    private $cantidad;
    private $estado;

    public function __GET($atr)
	{
			return $this->$atr;
	}
	public function __SET($atr, $vl)
	{
		$this->$atr=$vl;
    }
}