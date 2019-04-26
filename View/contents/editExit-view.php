<?php
	require_once "Controller/exitController.php";
	$control = new exitController();
	$salida = new  exitModel();
	$productoController = new productoController();	
	$categoriaController = new  CategoriaController();
	$tipoSalida = new tipoSalidaModel();
	$detalleSalida=$salida->buscar($_GET['id']);
?>
<style type="text/css">
	.container{  
		width:900px;
    height: 415px;
  }
</style>

    <div class="container">
		<div class="col-md-16">
      <div class="panel panel-default">
          <div class="panel-heading clearfix">&nbsp&nbsp
             <span class="glyphicon glyphicon-edit fa-fax3 fa-lg"></span>
             <label ><h4><b>Editar Salida</b></h4></label>
          </div>
      <div class="panel-body"> 

	<form action="" id="validate_form" method="POST">
		<div class="form-row">
			<div class="col-md-2 mb-3">
				<label>ID Salida</label><br>
				<input type="number" name="id_salida" id=""disabled class="form-control" value="<?php echo $detalleSalida->__GET('Salida_id_salida'); ?>"><br>
			</div>
			<!-- <div class="col-md-3 mb-3">
				<label>Fecha Salida</label><br>
				<input type="date" name="fecha_salida" value="<?php echo date("Y-m-d");?>"required class="form-control"><br><br>
			</div><br><br>
				<div class="col-md-14 mb-3">
				<label>Tipo Salida</label><br>
				<select name="tipo_salida_tipo_salida" class="custom-select" required>
	 				<option value="true" disabled>Seleccione tipo Salida</option>
					 <?php
					//  foreach ($tipoSalida->consultarTipoSalida() as $dato) {
					// 	 if ($dato->tipo_salida==$detalleSalida->__GET('tipo_salida_tipo_salida')) {
					// 		echo '<option value="'.$detalleSalida->__GET('tipo_salida_tipo_salida').'" selected>'.$dato->nombre.'</option>;';
					// 	 }else{
					// 		echo '<option value="'.$dato->tipo_salida.'">'.$dato->nombre.'</option>;';
					// 	 }
					//  }
					 ?>
				</select>
			</div><br><br> -->
			<div class="col-md-3 mb-3">
				<label>Buscar Producto</label><br>
				<input type="number" name="buscador" placeholder="Buscar Producto" required class="form-control"><br><br>
			</div><br><br>
		</div>
				<input type="submit" name="Buscar" class="btn btn-primary" value="Continuar Salida" >
				
	</form>
	<br>
	<?php
	// error_reporting(0);

	if (isset($_POST['Buscar'])) {
			$result= $productoController->buscar($_POST['buscador']);
			$_SESSION['id_productos']=$result->id_producto;
			$_SESSION['fecha_salidas']=$detalleSalida->__GET('fecha_salida');
			$_SESSION['mismo']=1;
	}else {
			$result= $productoController->buscar($detalleSalida->__GET('Producto_id_producto'));
			$_SESSION['id_producto']=$result->id_producto;
			$_SESSION['fecha_salida']=$detalleSalida->__GET('fecha_salida');
			$_SESSION['mismo']=0;	
	}
	if ($result->id_producto==null || $result->estado==0) {
		echo '<h1>Producto no registrado o Inactivo</h1>';
	}
	?>
	<section id="busqueda">
		  <h4>Resultado de busqueda</h4>
		    <br>
		    	<table  class="table table-bordered">
		     	<thead>
		     	 		<th>Referencia</th>
        			<th>Nombre</th>
        			<th>precio</th>
        			<th>IVA</th>
        			<th>Categoria</th>
        			<th>Cantidad</th>
       				<th>Estado</th>
		     	</thead>
		     	<tbody>
						<tr>
							<td><?php echo $result->referencia;?></td>
							<td><?php echo $result->nombre_producto; ?></td>
							<td><?php echo $result->precio_unitario; ?></td>
							<td><?php echo $result->IVA_Producto; ?></td>
							<td><?php $a=$categoriaController->buscar($result->Categoria_Producto_id_Categoria); echo $a->categoria;?></td>
							<td><?php echo $result->cantidad;?></td>
							<td><?php 
							if ($result->estado==1) {
								echo "Activo";
								}
								$_SESSION['cantidadp']=$result->cantidad;
							 ?></td>
							</tr>
		     	 	</tbody>
		     	 </table><br>	
				<div class="col-md-8 mb-3">
				<a href="list-exit.php"><input type="button" value="Cancelar" class="btn btn-danger btn-lg" style="float: right;"></a>				
				<section style="text-align: center;"><input type="submit" name="generar" class="btn btn-primary btn-lg" id="generar" value="Actualizar salida" onclick="myFunction()"></section>
			</div>
		</section>
	</center>
<br><hr>
<section id="salida" style="display:none">
	<form action="" method="post">
	<div class=" form-row">
    	<div class="col-md-4">
       <label>Ingresar la canidad:</label>
       <input type="number" name="cantidad" class="form-control" required placeholder="cantidad de Productos" value="<?php echo $detalleSalida->cantidad ?>">
			</div> 
			<div class="col-md-4">
			 <label>Fecha Salida</label><br>
				<input type="date" name="fecha_salida" value="<?php echo date("Y-m-d");?>"required class="form-control"><br><br>
				</div>
				<div class="col-md-4">
				<label>Tipo Salida</label><br>
				<select name="tipo_salida_tipo_salida" class="custom-select" required>
	 				<option value="true" disabled>Seleccione tipo Salida</option>
					 <?php
					 foreach ($tipoSalida->consultarTipoSalida() as $dato) {
						 if ($dato->tipo_salida==$detalleSalida->__GET('tipo_salida_tipo_salida')) {
							echo '<option value="'.$detalleSalida->__GET('tipo_salida_tipo_salida').'" selected>'.$dato->nombre.'</option>;';
						 }else{
							echo '<option value="'.$dato->tipo_salida.'">'.$dato->nombre.'</option>;';
						 }
					 }
					 ?>
				</select>
				</div>
		 <section style="text-align: center; margin-top: 40px;">
    <input type="submit" class="btn btn-primary btn-lg" style="margin: 0 10px;" name="registrar" value="Finalizar salida">
		<a href="list-exit.php"  class="btn btn-danger btn-lg" onclick="alert('Cancelar salida');myFunction();return false;">Cancelar</a>
</section>
<br>
<br>
<br>
<br>
<br>
<br>
</div> 
</form>
</section>
</div>
</div>
</div>
</div>

	<script>  
	$(document).ready(function(){
    $("#buscar").click(function(){
        $("#busqueda").toggle();
    });
});
$(document).ready(function(){  
    $('#validate_form').parsley();
});  

function myFunction() {
    var x = document.getElementById("salida");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
};
</script>

	<?php
		if (isset($_POST["registrar"])) {
			if (($_SESSION['cantidadp']-$_POST["cantidad"])<=0) {
				echo'<script type="text/javascript"> 
       swal({title: "ERROR",    
             text: "No se púdo registrar Salida Cantidad superior al stock.\n\n INTENTE DE NUEVO.", 
             type:"error", 
             confirmButtonText: "OK", 
             closeOnConfirm: false 
           }, 
           function(){ 
             window.location.href="add-exit.php"; 
           });  
       </script>';
			}else {
				
				if ($_SESSION['id_productos']==1) {
					$salida->__SET('Producto_id_producto', $_SESSION['id_producto']);
				}else {
					$salida->__SET('Producto_id_producto', $_SESSION['id_productos']);
				}
				$salida->__SET('tipo_salida_tipo_salida',  $_POST['tipo_salida_tipo_salida']);
				$salida->__SET('fecha_salida',  $_POST['fecha_salida']);
				$salida->__SET('producto_has_salida', $detalleSalida->__GET('producto_has_salida'));
				$salida->__SET('cantidad', $_POST["cantidad"]);
				$salida->__SET('cantidadP', $_SESSION['cantidadp']);
			if (($salida->fecha_salida == "")&&($salida->cantidad == "")&&($salida->Producto_id_producto == ""))  
			{
				echo'<script type="text/javascript"> 
																		swal({title: "ERROR",    
																					text: "No se púdo actualizar la Salida	 Revise los campos.", 
																					type:"error", 
																					confirmButtonText: "OK", 
																					closeOnConfirm: false 
																				}, 
																				function(){ 
																					window.location.href="add-exit.php"; 
																				});  
																	</script>';
																	return false;    
			}
				else if ($control->actualizar($salida)) {
										echo'<script type="text/javascript"> 
								swal({title: "LISTO",    
											text: "La Salida	 ha sido actualizada correctamente.", 
											type:"success", 
											confirmButtonText: "OK", 
											closeOnConfirm: false 
										}, 
										function(){ 
											window.location.href="list-exit.php"; 
										});  
							</script>'; 
							}
							else{ 

							echo'<script type="text/javascript"> 
								swal({title: "ERROR",    
											text: "No se púdo actualizar la Salida	. Intenta más tarde.", 
											type:"error", 
											confirmButtonText: "OK", 
											closeOnConfirm: false 
										}, 
										function(){ 
											window.location.href="list-exit.php"; 
										});  
					</script>';    
		?>
		<meta http-equiv="refresh" content="0; url=list-exit.php">
<?php
		} 
	}
} 

?>

 </div>