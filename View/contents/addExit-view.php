<?php
	require_once "Controller/exitController.php";
	$control = new exitController();
	$Salida = new  exitModel();
	$productoController = new productoController();	
	$categoriaController = new  CategoriaController();
	$tipoSalida = new tipoSalidaModel();
?>
 <style type="text/css">
  .container{  
    width:900px;
    height: 415px;
  }
</style>

    <br>
	<div class="container">
    <div class="col-md-16">
      <div class="panel panel-default">
          <div class="panel-heading clearfix">&nbsp&nbsp
             <span class="glyphicon glyphicon-list fa-fax3 fa-lg"></span>
             <label ><h4><b>Nueva Salida</b></h4></label>
          </div>
      <div class="panel-body"> 

	<form action="" id="validate_form" method="POST" class="form-horizontal">
		<div class="row">
			<div class="col-md-4">
				<label>Fecha Salida</label><br>
				<input type="date" name="fecha_salida" value="<?php echo date("Y-m-d");?>"required class="form-control"><br><br>
			</div>
				<div class="col-md-4">
				<label>Tipo Salida</label>
				<select name="tipo_salida_tipo_salida" class="custom-select form-control" required>
	 				<option value="true" selected disabled>Seleccione tipo Salida</option>
					 <?php
					 foreach ($tipoSalida->consultarTipoSalida() as $dato) {
							echo '<option value="'.$dato->tipo_salida.'">'.$dato->nombre.'</option>;';
					 }
					 ?>
				</select>
			</div>
			<div class="col-md-4">
				<label>Buscar Producto</label><br>
				<input type="number" name="buscador" placeholder="Buscar Producto" required class="form-control">
			</div>
		</div>
		<div class="col-md-12">
				<input type="submit" name="Buscar" class="btn btn-primary" value="Continuar Salida" >
        <input type="reset" value="Limpiar" class="btn btn-secondary">
        <a href="<?php echo SERVERURL; ?>listExit"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
		</div>
				
	</form>
</div>
</div>
</div>
	<?php
				if (isset($_POST["Buscar"])) {
				$result= $productoController->buscar($_POST["buscador"]);
				
				if ($result!=null and $result->estado==1) {
			$_SESSION['id_producto']=$result->id_producto;
			$_SESSION['fecha_salida']=$_POST['fecha_salida'];
			$_SESSION['tipo_salida_tipo_salida']=$_POST['tipo_salida_tipo_salida'];

	?>
	<section id="busqueda">
				<br><br><br>
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
						
					<section style="text-align: center;"><input type="submit" name="generar" class="btn btn-primary btn-lg" id="generar" value="Generar Salida" onclick="myFunction()"></section>
					</section>
				<?php 
					}else {
						echo "<h1>Producto Inactivo O Inexistente</h1>";
					}
				}
				?>
	</center>
<br><hr>
<div class="row">
    <div class="col-md-12">
	<form action="" method="post">
       <section id="Salida" style="margin-left: 100px; margin-right: 100px; display:none">
       <label>Ingresar la cantidad:</label>
       <input type="number" name="cantidad" class="form-control" required placeholder="cantidad de Productos">
     <section style="text-align: center; margin-top: 40px;">
    <input type="submit" class="btn btn-primary btn-lg" style="margin: 0 10px;" name="registrar" value="Finalizar Salida">
		<a href=""  class="btn btn-danger btn-lg" onclick="alert('Cancelar Salida');myFunction();return false;">Cancelar</a>
</section>
<!-- href="salidas.php" -->
<br>
</section> </form>
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
    var x = document.getElementById("Salida");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
};
</script>

	<?php
		if (isset($_POST["registrar"])) {
			if (($_SESSION['cantidadp']-$_POST["cantidad"]<=0)) {
				echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se púdo registrar Salida Cantidad superior al stock.\n\n INTENTE DE NUEVO.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="'.SERVERURL.'addExit"; 
                                      });  
                                </script>';
			}else{
				$Salida->__SET('Producto_id_producto', $_SESSION['id_producto']);
				$Salida->__SET('fecha_salida',  $_SESSION['fecha_salida']);
				$Salida->__SET('cantidad', $_POST["cantidad"]);
				$Salida->__SET('cantidadP', $_SESSION['cantidadp']);
				$Salida->__SET('tipo_salida_tipo_salida', $_SESSION['tipo_salida_tipo_salida']);
			if (($Salida->fecha_salida == "")&&($Salida->cantidad == "")&&($Salida->Producto_id_producto == ""))  
			{
			 echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se púdo registrar la Salida Revise los campos.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="'.SERVERURL.'addExit"; 
                                      });  
                                </script>';
                                return false;    
			}
			else if ($control->insertar($Salida)) {

                 echo'<script type="text/javascript"> 
                           swal({title: "LISTO",    
                                 text: "La Salida ha sido registrada correctamente.", 
                                 type:"success", 
                                 confirmButtonText: "OK", 
                                 closeOnConfirm: false 
                               }, 
                               function(){ 
                                 window.location.href="'.SERVERURL.'listExit"; 
                               });  
                         </script>'; 
												}
												else{ 
                         echo'<script type="text/javascript"> 
                          swal({title: "ERROR",    
                                text: "No se púdo registrar la Salida.", 
                                type:"error", 
                                confirmButtonText: "OK", 
                                closeOnConfirm: false 
                              }, 
                              function(){ 
                                window.location.href="'.SERVERURL.'addExit"; 
                              });  
                        </script>';    
		?>
		<meta http-equiv="refresh" content="0; url=http://localhost:8080/SIR/listExit">
<?php 
		}
	} 
}
?>

 </div>