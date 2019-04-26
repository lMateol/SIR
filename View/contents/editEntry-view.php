<?php
	require_once "Controller/entryController.php";
	$control = new entryController();
	$entrada = new  entryModel();
	$productoController = new productoController();	
	$categoriaController = new  CategoriaController();
	if ($_SESSION['id'.$contador]!=null) {
		$detalleEntrada=$entrada->buscar($_GET['id']);
	}
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
             <label ><h4><b>Editar Entrada <?php ?></b></h4></label>
          </div>
      <div class="panel-body"> 

	<form action="" id="validate_form" method="POST">
		<div class="form-row">
			<div class="col-md-4 mb-3">
				<label>ID Entrada</label><br>
				<input type="number" name="id_entrada" id=""disabled class="form-control" value="<?php echo $detalleEntrada->__GET('Entrada_id_entrada') ?>">
			</div>
			<!-- <div class="col-md-4 mb-3">
				<label>Fecha Entrada</label>
				<input type="date" name="fecha_entrada" value="<?php echo date('Y-m-d', strtotime($detalleEntrada->__GET('fecha_entrada'))) ?>"required class="form-control"><br><br>

			</div><br><br> -->
			<div class="col-md-4 mb-3">
				<label>Editar Producto</label><br>
				<input type="number" name="buscador" placeholder="Buscar Producto" required class="form-control">
			</div>
		</div>
				<input type="submit" name="Buscar" class="btn btn-primary" value="Consultar Producto" >
	</form>
	<br>
	<?php
	// error_reporting(0);

	if (isset($_POST['Buscar'])) {
			$result= $productoController->buscar($_POST['buscador']);
			$_SESSION['id_productos']=$result->id_producto;
			$_SESSION['mismo']=1;
	}else {
			$result= $productoController->buscar($detalleEntrada->__GET('Producto_id_producto'));
			$_SESSION['id_producto']=$result->id_producto;
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
				<a href="list-entry.php"><input type="button" value="Cancelar" class="btn btn-danger btn-lg" style="float: right;"></a>				
				<section style="text-align: center;"><input type="submit" name="generar" class="btn btn-primary btn-lg" id="generar" value="Actualizar salida" onclick="myFunction()"></section>
			</div>
		</section>
	</center>
<br><hr>
<div class="row">
    <div class="col-md-12">
	<form action="" method="post">
	
       <section id="salida" style="margin-left: 100px; margin-right: 100px; display:none">
       <label>Ingresar la canidad:</label>
       <input type="number" name="cantidad" class="form-control" required placeholder="cantidad de Productos" value="<?php echo $detalleEntrada->cantidad ?>">
     <section style="text-align: center; margin-top: 40px;">

		 <div class="col-md-6 mb-3">
				<label>Fecha Entrada</label>
				<input type="date" name="fecha_entrada" value="<?php echo date('Y-m-d', strtotime($detalleEntrada->__GET('fecha_entrada'))) ?>"required class="form-control"><br><br>

			</div><br><br>
    <input type="submit" class="btn btn-primary btn-lg" style="margin: 0 10px;" name="registrar" value="Finalizar salida">
		<a href=""  class="btn btn-danger btn-lg" onclick="alert('Cancelar salida');myFunction();return false;">Cancelar</a>
</section>
<!-- href="salidas.php" -->
<br>
</section> 
</form>
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
			if ($_SESSION['mismo']==0) {
				$entrada->__SET('Producto_id_producto', $_SESSION['id_producto']);
			}else {
				$entrada->__SET('Producto_id_producto', $_SESSION['id_productos']);
			}
			 $entrada->__SET('fecha_entrada',  $_POST['fecha_entrada']);
			 echo $entrada->__GET('fecha_entrada');
			 echo $entrada->__GET('fecha_entrada');

			$entrada->__SET('entrada_has_prducto', $detalleEntrada->__GET('entrada_has_prducto'));
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
			else if ($control->actualizar($entrada)) {
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
                                        window.location.href="'.SERVERURL.'listEntry"; 
                                      });  
                                </script>';    
		?>
		<meta http-equiv="refresh" content="0; url=http://localhost:8080/SIR/listEntry">
<?php 
	}
} ?>

 </div>