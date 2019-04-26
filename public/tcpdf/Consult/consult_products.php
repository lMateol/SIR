	
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
		
		function reportePdfProductos(){			
			$html="";
			$sql="select * from tbl_producto order by id_producto";
			$rs=mysqli_query($this->conn,$sql);
			$i=0;


            $html=$html. '<head>
             <img src="../../public/Rodillo.png" style="width: 100px; height: 100px" alt="" /> 
             <head>';
			$html=$html.'<div align="center">
			<h1>Reporte de productos.</h1>
			<br /><br /><br />			
			<table border="1" style="border: 1px solid black;" bordercolor="#0000CC"bordercolordark="#FF0000">';		
			$html=$html.'
			<tr bgcolor="#2E2EFE">
			<td><font color="#FFFFFF">Referencia</font></td>
			<td><font color="#FFFFFF">Nombre producto</font></td>
			<td><font color="#FFFFFF">Precio Unitario</font></td>
			<td><font color="#FFFFFF">iva</font></td>
			<td><font color="#FFFFFF">cantidad</font></td></tr>';
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
				$html = $html. $row["precio_unitario"];
				$html = $html.'</td><td>';
				$html = $html. $row["IVA_Producto"];
				$html = $html.'</td><td>';
				$html = $html. $row["cantidad"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
     		 
		}
		//-----------------------------------------------------------------------------------------------------------------------		
	}

?>

