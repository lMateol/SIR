<?php
include_once "Model/config.php";
include_once "Controller/productController.php";
require_once "Controller/categoryController.php";
	class entryModel extends conexion
	{
		private $entrada_has_prducto;
		private $Entrada_id_entrada;
		private $Producto_id_producto;
		private $cantidad;
		private $fecha_entrada;
		private $cantidadP;
		private $nombre_producto;
		private $referencia;

		public function __GET($atr)
		{
			return $this->$atr;
		}
		public function __SET($atr, $vl)
		{
			$this->$atr=$vl;
		}

		public function insertar(entryModel $entrada)
		{
			$insertar = "INSERT INTO tbl_entrada(fecha_entrada) VALUES (?)";
			try{
				$this->conexion->prepare($insertar)->execute(array(
					$entrada->__GET('fecha_entrada'),
				));

				$idEntradacon = "SELECT max(id_entrada) as id_entrada ,fecha_entrada FROM tbl_entrada";
				$idEntrada=$this->conexion->prepare($idEntradacon);
				$idEntrada->execute();
				$dato=$idEntrada->fetch(PDO::FETCH_OBJ);
				
				$insertardetalle = "INSERT INTO tbl_detalle_entrada (Entrada_id_entrada, Producto_id_producto, cantidad) VALUES ( ?, ?, ?)";

				$this->conexion->prepare($insertardetalle)->execute(array(
					$dato->id_entrada,
					$entrada->__GET('Producto_id_producto'),
					$entrada->__GET('cantidad'),
				));
				
				$total=$entrada->__GET('cantidad') + $entrada->__GET('cantidadP');
				$cantidadcon = "UPDATE tbl_producto SET cantidad=? WHERE id_producto=?";
				$cantidadresult=$this->conexion->prepare($cantidadcon)->execute(array(
					$total,
					$entrada->__GET('Producto_id_producto')
				));

				return true;
			}catch (Exception $e){
				echo "Error al isertar datos en Entrada: ".$e->getMessage();
			}
		}

		public function listar()
		{
			$datosEntry = array();
			$consultar = "SELECT ent.id_entrada, pro.nombre_producto, pro.referencia, dent.cantidad, ent.fecha_entrada 
			FROM tbl_entrada ent INNER JOIN tbl_detalle_entrada dent ON ent.id_entrada = dent.Entrada_id_entrada INNER JOIN 
			tbl_producto pro ON pro.id_producto = dent.Producto_id_producto ORDER BY id_entrada";
			try{
				$resultado = $this->conexion->query($consultar);
				// $resultado = execute();

				foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $dato) {
					$entrada = new entryModel();
					$entrada->__SET('Entrada_id_entrada', $dato->id_entrada);
					$entrada->__SET('nombre_producto', $dato->nombre_producto);
					$entrada->__SET('referencia', $dato->referencia);
					$entrada->__SET('cantidad', $dato->cantidad);
					$entrada->__SET('fecha_entrada', $dato->fecha_entrada);

					$datosEntry[] = $entrada;
				}
				return $datosEntry;
			}catch(Exception $e){
				echo "Error al consultar".$e->getMessage();
			}
		}

		public function buscar($id)
		{
			$buscar  = "SELECT ent.id_entrada, ent.fecha_entrada, det.cantidad,det.Producto_id_producto,det.entrada_has_prducto FROM tbl_entrada ent, tbl_detalle_entrada det 
			where ent.id_entrada=det.Entrada_id_entrada and det.Entrada_id_entrada=?";
			try{
				$resultado = $this->conexion->prepare($buscar);
				$resultado->execute(array($id));

				$datos = $resultado->fetch(PDO::FETCH_OBJ);
				$usuario = new entryModel();
				$usuario->__SET('entrada_has_prducto', $datos->entrada_has_prducto);
				$usuario->__SET('Entrada_id_entrada', $datos->id_entrada);
				$usuario->__SET('fecha_entrada', $datos->fecha_entrada);
				$usuario->__SET('cantidad', $datos->cantidad);
				$usuario->__SET('Producto_id_producto', $datos->Producto_id_producto);
				return $usuario;
			}catch (Exception $e){
				echo "Error al buscar datos ".$e->getMessage();
			}
		}

		public function actualizar(entryModel $entrada)
		{
			$buscar  = "UPDATE tbl_detalle_entrada SET Producto_id_producto=?, cantidad=? WHERE entrada_has_prducto=?";
			try{
				$resultado = $this->conexion->prepare($buscar);
				$resultado->execute(array(
					$entrada->__GET('Producto_id_producto'),
					$entrada->__GET('cantidad'),
					$entrada->__GET('entrada_has_prducto'),
				));

				$b  = "UPDATE tbl_entrada SET fecha_entrada=? WHERE id_entrada=?";
				$re = $this->conexion->prepare($b);
				$re->execute(array(
					$entrada->__GET('fecha_entrada'),
					$entrada->__GET('entrada_has_prducto'),
				));

				$total=$entrada->__GET('cantidad') + $entrada->__GET('cantidadP');
				$cantidadcon = "UPDATE tbl_producto SET cantidad=? WHERE id_producto=?";
				$cantidadresult=$this->conexion->prepare($cantidadcon)->execute(array(
					$total,
					$entrada->__GET('Producto_id_producto')
				));
				
				return true;
			}catch (Exception $e){
				echo "Error al buscar datos ".$e->getMessage();
			}
		}

		public function eliminar($id)
		{
			$borrar = "DELETE FROM `tbl_detalle_entrada` WHERE `entrada_has_prducto`=?;
			DELETE FROM tbl_entrada WHERE id_entrada=?";
			try{
				$this->conexion->prepare($borrar)->execute(array($id,$id));
				return true;
			}catch (Exception $e){
				echo "Error al eliminar datos ".$e->getMessage();
			}
		}
	}
?>