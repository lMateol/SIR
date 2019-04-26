	
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
		function reportePdfEntradas(){			
			$html="";
			//$sql="select * from tbl_entrada order by id_entrada";
            
            $sql="SELECT ent.id_entrada, pro.nombre_producto, pro.referencia, dent.cantidad, ent.fecha_entrada 
			FROM tbl_entrada ent INNER JOIN tbl_detalle_entrada dent ON ent.id_entrada = dent.Entrada_id_entrada INNER JOIN 
			tbl_producto pro ON pro.id_producto = dent.Producto_id_producto ORDER BY id_entrada";

			$rs=mysqli_query($this->conn,$sql);
			$i=0;

			$html=$html. '<head>
             <img src="../../public/Rodillo.png" style="width: 100px; height: 100px" alt="" /> 
             <head>';
			$html=$html.'<div align="center">
			<h1>Reporte de entradas.</h1>
			<br /><br />			
			<table border="1" style="border: 1px solid black;" bordercolor="#0000CC"bordercolordark="#FF0000">';	
			$html=$html.'<tr bgcolor="#2E2EFE"><td><font color="#FFFFFF">
			Referencia</font></td><td><font color="#FFFFFF">
			Nombre Producto</font></td><td><font color="#FFFFFF">
			Cantidad</font></td><td><font color="#FFFFFF">
			Fecha Entrada</font></td></tr>';
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
				$html = $html. $row["fecha_entrada"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}
		//-----------------------------------------------------------------------------------------------------------------------		
	}

?>

