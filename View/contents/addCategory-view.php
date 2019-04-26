<?php 
require_once 'Controller/categoryController.php';
require_once 'Model/categoryModel.php';
$controls = new CategoriaController();
?>


<style type="text/css">
    .container{  
     width:650px;
     height: 300px;
   }
</style>
<br>
  <div class="container">

    <div class="col-md-16">
      <div class="panel panel-default">
           <div class="panel-heading clearfix">&nbsp&nbsp
             <span class="fa fa-user-plus fa-fax3 fa-lg"></span>
             <label ><h4><b>Nueva Categoria</b></h4></label>
          </div>
      <div class="panel-body"> 
		<form action="#" method="post" id="validate_form" class="ml-2">
			<div class="form-row">
        <div class="col-md-6 mb-3">
					<label>Nombre Categoría</label><br>
					<input type="text" name="categoria" class="form-control" required=""><br>
				</div>
				<div class="col-md-6 mb-3">
					<label>Estado</label><br>
					<select name="estado" class="custom-select form-control" required="">
						<option value="true" selected disabled>Seleccione una categoria</option>
						<option value="1">Activo</option>
						<option value="0">Inactivo</option>
					</select><br>
				</div>
			</div>
      <div class="col-md-12 mb-3">
			<input type="submit" id="registrar" name="registrar" class="btn btn-primary" value="Registrar" >
      <input type="reset" value="Limpiar" class="btn btn-secondary">
     <a href="<?php echo SERVERURL; ?>listCategory"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
   </div>
		</form>
  </div>
</div>
</div>
</div>

		<script>  
$(document).ready(function(){  
    $('#validate_form').parsley();
});  
</script>
<?php 
if (isset($_POST['registrar'])) {
  $categoria = new CategoriaModel();

	$categoria->__SET('categoria',$_POST['categoria']);
  $categoria->__SET('estado',$_POST['estado']);

	if (($categoria->categoria == "")&&($categoria->estado == ""))  
		{
			 echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "Revise los campos.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="'.SERVERURL.'addCategory"; 
                                      });  
                                </script>';
                                return false;    
		}
	else if ($controls->insertar($categoria)) {

                  echo'<script type="text/javascript"> 
                            swal({title: "LISTO",    
                                  text: "Categoria registrada correctamente..", 
                                  type:"success", 
                                  confirmButtonText: "OK", 
                                  closeOnConfirm: false 
                                }, 
                                function(){ 
                                  window.location.href="'.SERVERURL.'addCategory"; 
                                });  
                          </script>'; 
                          }else{ 

                          echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se púdo registrar la categoria.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="'.SERVERURL.'addCategory"; 
                                      });  
                                </script>';    
		?>
		<meta http-equiv="refresh" content="0; url=http://localhost:8080/SIR/addCategory">
<?php 
	}
} ?>

 </div>

</body>
</html>