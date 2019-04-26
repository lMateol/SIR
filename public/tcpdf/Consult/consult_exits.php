	
<?php 

    require "../../public/tcpdf/config/config.php";
	class consulta{
		var $conn;
		var $conexion;
		function consulta(){		
			$this->conexion= new  Conexion();				
			$this->conn=$this->conexion->conectarse();
		}	
		//-----------------------------------------------------------------------------------------------------------------------
		//-----------------------------------------------------------------------------------------------------------------------
		function reportePdfSalidas(){			
			$html="";
            $sql = "SELECT sali.id_salida,sali.tipo_salida_tipo_salida, pro.nombre_producto, pro.referencia, dexit.cantidad, sali.fecha_salida 
			FROM tbl_salida sali INNER JOIN tbl_detalle_salida dexit ON sali.id_salida = dexit.Salida_id_salida INNER JOIN 
			tbl_producto pro ON pro.id_producto = dexit.Producto_id_producto ORDER BY id_salida";

			$rs=mysqli_query($this->conn,$sql);
			$i=0;
			$html=$html. '<head>
             <img src="../../public/Rodillo.png" style="width: 100px; height: 100px" alt="" /> 
             <head>';

			$html=$html.'<div align="center">
			<h1>Reporte de salidas.</h1>
			<br /><br />			
			<table border="1" style="border: 1px solid black;" bordercolor="#0000CC"bordercolordark="#FF0000">';		
			$html=$html.'<tr bgcolor="#2E2EFE"><td><font color="#FFFFFF">
			Referencia</font></td><td><font color="#FFFFFF">
			Nombre Producto</font></td><td><font color="#FFFFFF">
			cantidad</font></td><td><font color="#FFFFFF">
			Fecha Salida</font></td><td><font color="#FFFFFF">
			Tipo Salida</font></td></tr>';
			while ($row = mysqli_fetch_array($rs)){
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#95B1CE">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["referencia"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_producto"];
				$html = $html.'</td><td>';
				$html = $html. $row["cantidad"];
				$html = $html.'</td><td>';
				$html = $html. $row["fecha_salida"];
				$html = $html.'</td><td>';
				$html = $html. $row["tipo_salida_tipo_salida"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}
		//-----------------------------------------------------------------------------------------------------------------------		
	}

?>

