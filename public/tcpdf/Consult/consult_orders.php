
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
		function comprobantePdfPedido(){			
			$html="";
			$sql="select * from tbl_pedido order by id_pedido";
			$rs=mysqli_query($this->conn,$sql);
			$dato=mysqli_query($this->conn,$sql);
			$i=0;

		$html=$html. '<head>
             <img src="../../public/Rodillo.png" style="width: 100px; height: 100px" alt="" /> 
             <head>';
            $html=$html.'<div align="center">
            <label>Nit:  9000.324995-9</label>
            <br>
            <label>IVA: Regimen Común</label>
            <br>
            <label>Actividad Economica:  103-11.04x1.000</label>
            <br>
            <label>Resolución DIAN Nro 320001394592 De 2018/04/28</label>
            <br><br>
            <label>Cra 108 Nro 19-62 Telefax: 2679629  Telefono: 2676353  Email: Informacion@industriasmastder.com - Bogotá</label>
            </div><br>';


			while ($datos = mysqli_fetch_array($dato)){
            

            $html=$html.'<table border="0" width="100%" cellpadding="5" cellspacing="5" > ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td width="50%"> ';
            $html=$html.'  <table border="1"> ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td colspan="2"> ';
            $html=$html.'  SEÑORES: ';
            $html=$html.'  </td>';
            $html=$html.'  </tr> ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td colspan="2"> ';
            $html=$html.'  DIRECCIÓN: ';
            $html=$html.'  </td>';
            $html=$html.'  </tr> ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td> ';
            $html=$html.'  C.C O NIT:';
            $html=$html.'  </td> ';
            $html=$html.'  <td>';
            $html=$html.'  TEL: ';
            $html=$html.'  </td> ';
            $html=$html.'  </tr> ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td> ';
            $html=$html.'  CIUDAD:';
            $html=$html.'  </td> ';
            $html=$html.'  <td> ';
            $html=$html.'  DPTO: ';
            $html=$html.'  </td> ';
            $html=$html.'  </tr> ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td> ';
            $html=$html.'  FORMA DE PAGO: ';
            $html=$html.'  </td> ';
            $html=$html.'  <td> ';
            $html=$html.'  VENDEDOR: ';
            $html = $html. $datos["vendedor"];
            $html=$html.'  </td> ';
            $html=$html.'  </tr> ';
            $html=$html.'  </table> ';
            $html=$html.'  </td> ';
            $html=$html.'  <td width="50%"> ';
            $html=$html.'  <table border="1"> ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td>  ';
            $html=$html.'  FECHA FACTURA  ';
            $html=$html.'  </td> ';
            $html=$html.'  <td> ';
            $html=$html.'  FECHA VENCIMIENTO  ';
            $html=$html.'  </td> ';
            $html=$html.'  </tr> ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td>  ';
            $html=$html.'  AÑO MES DIA ';
            $html=$html.'  </td> ';
            $html=$html.'  <td>  ';
            $html=$html.'  AÑO MES DIA ';
            $html=$html.'  </td>  ';
            $html=$html.'  </tr>  ';
            $html=$html.'  <tr>  ';
            $html=$html.'  <td> ';
            $html = $html. $datos["fecha_pedido"];
            $html=$html.'  </td>  ';
            $html=$html.'  <td> ';
            $html = $html. $datos["fecha_vencimiento"];
            $html=$html.'  </td> ';
            $html=$html.'  </tr> ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td colspan="2"> ';
            $html=$html.'  DESPACHADO POR: ';
            $html = $html. $datos["despachado_por"];
            $html=$html.'  </td>';
            $html=$html.'  </tr> ';
            $html=$html.'  </table> ';
            $html=$html.'  </td> ';
            $html=$html.'  </tr> ';
            $html=$html.'  </table> ';
}
		/*	$html=$html.'<div align="center">
			<table border="1" style="border: 1px solid black;" bordercolor="#0000CC"bordercolordark="#FF0000">';	
			$html=$html.'<tr bgcolor="#2E2EFE">
			<td><font color="#FFFFFF">Id Pedido</font></td>
			<td><font color="#FFFFFF">Persona</font></td>
			<td><font color="#FFFFFF">Vendedor</font></td>
			<td><font color="#FFFFFF">Fecha Pedido</font></td>
			<td><font color="#FFFFFF">Fecha Vencimiento</font></td>
			<td><font color="#FFFFFF">Despachhado Por</font></td></tr>';
			while ($row = mysqli_fetch_array($rs)){
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#95B1CE">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["id_pedido"];
				$html = $html.'</td><td>';
				$html = $html. $row["Persona_id_persona"];
				$html = $html.'</td><td>';
				$html = $html. $row["vendedor"];
				$html = $html.'</td><td>';
				$html = $html. $row["fecha_pedido"];
				$html = $html.'</td><td>';
				$html = $html. $row["fecha_vencimiento"];
				$html = $html.'</td><td>';
				$html = $html. $row["despachado_por"];
				
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';	*/		
            $html=$html.'<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';	
     		$html=$html.' 
     		<table  border="1" style:"border: 1px solid black;">

            <tr>
            <td> OBSERVACIONES : BANCOLOMBIA AHORROS 22329169000<br>medellin@industriasmastder.com Tel: 2859578</td>
            <td> Sub Total</td>
            <td> $</td>

            </tr>

            <tr>
            <td> NOTA: </td><td> DCTO %</td>
            <td> $</td>
            </tr>
            <tr>
            <td> SON: </td><td> SUB TOTAL</td>
            <td> $</td>
            </tr>
            <tr>
            <td> Rodillos Mastder</td><td> I.V.A</td>
            <td> $</td>

            </tr>
            
       </table>';
       return ($html);
		}
		//-----------------------------------------------------------------------------------------------------------------------		
	}

?>

