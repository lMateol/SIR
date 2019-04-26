<?php
	require_once "Controller/entryController.php";
	$control = new entryController();
	$entrada = new  entryModel();
	$productoController = new productoController();	
	$categoriaController = new  CategoriaController();
?>
<style type="text/css">
  .container{  
    width:700px;
    height: 415px;
  }
</style>

    <br>
	<div class="container">
    <div class="col-md-16">
      <div class="panel panel-default">
          <div class="panel-heading clearfix">&nbsp&nbsp
             <span class="glyphicon glyphicon-list fa-fax3 fa-lg"></span>
             <label ><h4><b>Nueva Entrada</b></h4></label>
          </div>
      <div class="panel-body"> 

	<form action="" id="validate_form" method="POST" class="form-horizontal">
	
		<div class="row">
			<div class="col-md-4">
				<label class="control-label">Fecha Entrada</label><br>
				<input type="date" name="fecha_entrada" value="<?php echo date("Y-m-d");?>"required class="form-control input-sm">
			</div>
			<div class="col-md-4">
				<label class="control-label">Buscar Producto</label>
				<input type="number" name="buscador" placeholder="Buscar Producto" required class="form-control input-sm">
			</div>
		</div><br><br>
		<div class="col-md-12">
			<input type="submit" name="Buscar" class="btn btn-primary" value="Continuar Entrada" >
      <input type="reset" value="Limpiar" class="btn btn-secondary">
      <a href="<?php echo SERVERURL; ?>listEntry"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
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
			$_SESSION['fecha_entrada']=$_POST['fecha_entrada'];

	?>
	<section id="busqueda">
				
		     	 <h4 class="col-md-12 text-center">Resultado de busqueda</h4>
		     	 <br>
		     	 <table class="table table-bordered">
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
						
					<section style="text-align: center;"><input type="submit" name="generar" class="btn btn-primary btn-lg" id="generar" value="Generar Entrada" onclick="myFunction()"></section>
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
       <section id="Entrada" style="margin-left: 100px; margin-right: 100px; display:none">
       <label>Ingresar la canidad:</label>
       <input type="number" name="cantidad" class="form-control" required placeholder="cantidad de Productos">
     <section style="text-align: center; margin-top: 40px;">
    <input type="submit" class="btn btn-primary btn-lg" style="margin: 0 10px;" name="registrar" value="Finalizar Entrada">
		<a href=""  class="btn btn-danger btn-lg" onclick="alert('Cancelar Entrada');myFunction();return false;">Cancelar</a>
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
    var x = document.getElementById("Entrada");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
};
</script>

	<?php
		if (isset($_POST["registrar"])) {
			$entrada->__SET('Producto_id_producto', $_SESSION['id_producto']);
			$entrada->__SET('fecha_entrada',  $_SESSION['fecha_entrada']);
			$entrada->__SET('cantidad', $_POST["cantidad"]);
			$entrada->__SET('cantidadP', $_SESSION['cantidadp']);
			if (($entrada->fecha_entrada == "")&&($entrada->cantidad == "")&&($entrada->Producto_id_producto == ""))  
		{
			  echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                         text: "No se púdo actualizar la Entrada Revise los campos.", 
                                         type:"error", 
                                         confirmButtonText: "OK", 
                                         closeOnConfirm: false 
                                       }, 
                                       function(){ 
                                         window.location.href="'.SERVERURL.'addEntry"; 
                                       });  
                                 </script>';
                                 return false;    
		}
	else if ($control->insertar($entrada)) {

                  echo'<script type="text/javascript"> 
                             swal({title: "LISTO",    
                                   text: "La Entrada ha sido actualizada correctamente.", 
                                   type:"success", 
                 confirmButtonText: "OK", 
                                   closeOnConfirm: false 
                                 }, 
                                 function(){ 
                                  window.location.href="'.SERVERURL.'listEntry"; 
                               });  
                         </script>'; 
									 				}
									 				else{ 

                           echo'<script type="text/javascript"> 
                                   swal({title: "ERROR",    
                                         text: "No se púdo actualizar la Entrada. Intenta más tarde.", 
                                         type:"error", 
                                        confirmButtonText: "OK", 
                                         closeOnConfirm: false 
                                       }, 
                                       function(){ 
                                         window.location.href="'.SERVERURL.'addEntry"; 
                                       });  
                                 </script>';    
		 ?>
		 <meta http-equiv="refresh" content="0; url=http://localhost:8080/SIR/listEntry"> 
<?php 
	}
} ?>

 </div>