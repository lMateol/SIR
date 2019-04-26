<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	 ob_start();
	session_start();
	/* Connect To Database*/
	include("../../config/db.php");
	include("../../config/conexion.php");
	$session_id= session_id();
	$sql_count=mysqli_query($con,"select * from tmp where session_id='".$session_id."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('No hay productos agregados a la cotizacion')</script>";
	echo "<script>window.close();</script>";
	exit;
	}

	require_once(dirname(__FILE__).'/../html2pdf.class.php');
		
	//Variables por GET
	$proveedor=intval($_GET['proveedor']);
	$estadoP=mysqli_real_escape_string($con,(strip_tags($_REQUEST['estado'], ENT_QUOTES)));
	$transporte=mysqli_real_escape_string($con,(strip_tags($_REQUEST['transporte'], ENT_QUOTES)));
	$condiciones=mysqli_real_escape_string($con,(strip_tags($_REQUEST['condiciones'], ENT_QUOTES)));
	$comentarios=mysqli_real_escape_string($con,(strip_tags($_REQUEST['comentarios'], ENT_QUOTES)));
	//Fin de variables por GET
	$sql=mysqli_query($con, "select LAST_INSERT_ID(id_pedido) as last from tbl_pedido order by id_pedido desc limit 0,1 ");
	$rw=mysqli_fetch_array($sql);
	$numero_pedido=$rw['last'];	
	$perfil=mysqli_query($con,"select * from perfil limit 0,1");//Obtengo los datos de la emprea
	$rw_perfil=mysqli_fetch_array($perfil);
	
	$sql_proveedor=mysqli_query($con,"select * from tbl_persona where id_persona='$proveedor' limit 0,1");//Obtengo los datos del proveedor
	$rw_proveedor=mysqli_fetch_array($sql_proveedor);
	// get the HTML
	//CODIGO JOULER
	$sql=mysqli_query($con, "select * from tbl_producto, tmp where tbl_producto.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");
	$tabblaDetalle="";

	try {
		$conec = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
		// set the PDO error mode to exception
		$conec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// echo "Connected successfully"; 
		$sumador_total=0;
		$date=date("Y-m-d H:i:s");
		$insert=mysqli_query($con,"INSERT INTO tbl_pedido VALUES ('','$proveedor','$condiciones','Liliana Ospina','$date','$date','$transporte','$estadoP','$comentarios')");
		echo '
		<table cellspacing="0" style="width: 100%;">
        <tr>

            <td  style="width: 15%; color: #444444;">
                <img style="width: 100%;" src="http://localhost/SIR/public/img/Rodillos GBP.png" alt="Logo"><br>
                
            </td>
			<td style="width: 75%;text-align:right;font-size:24px;color:#2c3e50">
			COMPROOBANTE Nº '.$condiciones.'
			</td>
			
        </tr>
    </table>
		';
		echo '<h1>Informacion Del Pedido</h1>';
		echo '<h3>Productos</h3>';
		echo ' <table cellspacing="0" style="width: 100%; border: solid 0px #7f8c8d; text-align: center; font-size: 10pt;padding:1mm;">
		<tr >
			<th class="pumpkin" style="width: 14% ">CODIGO</th>
			<th class="pumpkin" style="width: 7% ">CANT.</th>
			<th class="pumpkin" style="width: 55%">DESCRIPCION</th>
			<th class="pumpkin" style="width: 14%;text-align:right">PRECIO UNIT.</th>
			<th class="pumpkin" style="width: 10%;text-align:right">TOTAL</th>
			<th class="pumpkin" style="width: 10%;text-align:right">VALOR TOTAL PEDIDO</th>
		</tr>';
		while ($row=mysqli_fetch_array($sql))
			{
			$id_tmp=$row["id_tmp"];
			$id_producto=$row["id_producto"];
			$referencia=$row['referencia'];
			$cantidad=$row['cantidad_tmp'];
			$nombre_producto=$row['nombre_producto'];
			$id_marca_producto=$row['Categoria_Producto_id_Categoria'];
			if (!empty($id_marca_producto))
			{
			$sql_marca=mysqli_query($con,"select categoria from tbl_categoria_producto where id_Categoria='$id_marca_producto'");
			$rw_marca=mysqli_fetch_array($sql_marca);
			$nombre_marca=$rw_marca['categoria'];
			$marca_producto=" ".strtoupper($nombre_marca);
			}
			else {$marca_producto='';}
			$precio_venta=$row['precio_tmp'];
			$precio_venta_f=number_format($precio_venta,2);//Formateo variables
			$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
			$precio_total=$precio_venta_r*$cantidad;
			$precio_total_f=number_format($precio_total,2);//Precio total formateado
			$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
			$sumador_total+=$precio_total_r;//Sumador
			echo '
			<tr>
			<td class="jouler" style="width: 14%; text-align: center">'.$referencia.'</td>
			<td class="jouler" style="width: 7%; text-align: center">'.$cantidad.'</td>
			<td class="jouler" style="width: 55%; text-align: left">'.$nombre_producto.$marca_producto.'</td>
			<td class="jouler" style="width: 14%; text-align: right">'.$precio_venta_f.'</td>
			<td class="jouler" style="width: 10%; text-align: right">'.$precio_total_f.'</td>
			</tr> 	';
		// Insert en la tabla detalle_pedido
		$insertar = "INSERT INTO tbl_detalle_pedido(`Pedido_id_pedido`, `Producto_id_producto`, `cantidad`, `precio`, `sub_total1`, `descuento`, `sub_total2`, `iva_total`, `total_pagar`)
		VALUES (?,?,?,?,?,?,?,?,?)";
		$conec->prepare($insertar)->execute(array(
			$numero_pedido,
			$id_producto,
			$cantidad,
			$precio_venta_r,
			1000,
			2,
			500,
			500,
			500
		));
		// echo $numero_pedido."g".$id_producto."asd".$cantidad."asd".$precio_venta_r."asd";
		// $insert_detail=mysqli_query($con, "INSERT INTO tbl_detalle_pedido VALUES ('','$numero_pedido','$id_producto','$cantidad','$precio_venta_r','1000','1000','1000','1000','1000')");
		}
		echo'</table>';
		$total_neto=number_format($sumador_total,2,'.','');
		$iva=intval($rw_perfil['iva']);
		$total_iva=($total_neto* $iva) / 100;
		$total_iva=number_format($total_iva,2,'.','');
		$sumador_total=$total_neto+$total_iva; 
		echo '
		<table cellspacing="0" style="width: 100%; border: solid 0px black; background: white; font-size: 11pt;padding:1mm;">
		<tr>
			<th style="width: 50%; text-align: right;"></th>
			<th style="width: 37%; text-align: right;">SUBTOTAL &#36;</th>
			<th style="width: 13%; text-align: right;">'. number_format($total_neto,2).'</th>
		</tr>
		<tr>
			<th class="pumpkin" style="width: 50%; text-align: center;">Comentarios o instruciones especiales</th>
			<th style="width: 37%; text-align: right;">IVA  &#36;</th>
			<th style="width: 13%; text-align: right;">'. number_format($total_iva,2).'</th>
		</tr>
		<tr>
			<td class="border-left border-bottom border-right" style="width: 50%;">'. $comentarios.'</td>
			<th  style="width: 37%; text-align: right;">TOTAL &#36; </th>
			<th style="width: 13%; text-align: right;">'. number_format($sumador_total,2).'</th>
		</tr>
		</table>
		';
		// $date=date("Y-m-d H:i:s");
		// $insert=mysqli_query($con,"INSERT INTO tbl_pedido VALUES ('','$proveedor','$condiciones','Liliana Ospina','$date','$date','$transporte','1','$comentarios')");
		$delete=mysqli_query($con,"DELETE FROM tmp WHERE session_id='".$session_id."'");

		}catch(PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}
	echo '
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
		<tr>
			<td class="pumpkin" style="width:45%; "><h3>Informacion Cliente</h3></td>
			<td  style="width:10%; "></td>
			<td class="pumpkin" style="width:45%; "><h3>Informacion Vendedor</h3></td>
		</tr>
		<tr>
			<td style="width:45%; ">
				'. $rw_proveedor['nombres'].'<br>
				Dirección: '. $rw_proveedor['direccion'].'<br> 
				Teléfono: '. $rw_proveedor['telefono'].'<br>
				Documento: '. $rw_proveedor['documento'].'
			</td>
			<td  style="width:10%; "></td>
			<td style="width:45%; ">
				'. $rw_perfil['nombre_comercial'] .'<br>
				Dirección:'. $rw_perfil['direccion'] .'<br>
				Teléfono: '. $rw_perfil['telefono'] .'<br>
				Email: '. $rw_perfil['email'] .'
			</td>
			
		</tr>
	</table>
	<br>
	';
	$estadoPE = ($estadoP==1) ? "Pendiente" : "pago" ;
	echo'
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
		<tr>
			<td class="pumpkin" style="width:33%; ">TRANSPORTE</td>
			<td class="pumpkin" style="width:34%; ">Estado Pedido</td>
			<td class="pumpkin" style="width:33%; text-align:right ">FECHA</td>
		</tr>
		<tr>
			<td style="width:33%; ">
				'.$transporte.'
			</td>
			
			<td style="width:34%; ">
			'.$estadoPE.'	
			</td>
			<td  style="width:33%; text-align:right">'.date("d-m-Y").'</td>
		</tr>
	</table>
	';
	echo '
	<br>
	<p style="font-size:11pt;text-align:center">Si tiene alguna consulta sobre este pedido por favor contácte a:<br>
		'. $rw_perfil['propietario'].'", <strong>Teléfono: </strong>"'.$rw_perfil['telefono'].'", <strong>Email:</strong> "'.$rw_perfil['email'].'<br>
	</p>
	';

	//CODIGO DE EL MEN COMENTADO
    //  include(dirname('__FILE__').'/res/pedido_html.php');
    // $content = ob_get_clean();

    // try
    // {
    //     // init HTML2PDF
    //     $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
    //     // display the full page
    //     $html2pdf->pdf->SetDisplayMode('fullpage');
    //     // convert
    //     $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    //     // send the PDF
    //     $html2pdf->Output('Cotizacion.pdf');
    // }
    // catch(HTML2PDF_exception $e) {
    //     echo $e;
    //     exit;
    // }
