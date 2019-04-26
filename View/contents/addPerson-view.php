<?php
	require_once "Controller/personController.php";
	$control = new personController();
	$usuario = new  personModel();
	$tipoDocumentoPersona = new tipoDocumentoPersonModel();
?>
<style type="text/css">
  .container{  
   width:900px;
   height: 575px;
 }

 hr {
  height: 5px;
  background-color: #D6D4D4;
}
</style>
    <br>
	<div class="container">

		<div class="col-md-16">
      <div class="panel panel-default">
           <div class="panel-heading clearfix">&nbsp&nbsp
             <span class="fa fa-user-plus fa-fax3 fa-lg"></span>
             <label ><h4><b>Nueva Persona</b></h4></label>
          </div>
      <div class="panel-body"> 
		<form action="" method="POST" id="validate_form" class="ml-2">
			<div class="form-row">
				<div class="col-md-4 mb-3">
					<label>Nombres</label>
					<input type="text" name="nombres" class="form-control" required="">
				</div>
				<div class="col-md-4 mb-3">
					<label>Apellidos</label>
					<input type="text" name="apellidos" class="form-control" required="">
				</div>
				<div class="col-md-4 mb-3 form-group">
					<label>Tipo Documento</label>
					<select name="tipo_documento_tipo_documento" class="custom-select form-control" required="">
					<option value="true" selected disabled>Seleccione un documento</option>
					<?php
						foreach ($tipoDocumentoPersona->consultarTipoDocumento() as $dato) {
							echo '<option value="'.$dato->tipo_documento.'">'.$dato->nombre_documento	.'</option>';
						}
					?>
					</select>
				</div>
				<div class="col-md-4 mb-3">
					<label>Documento</label><br>
					<input type="text" name="documento" class="form-control" required=""><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Teléfono</label><br>
					<input type="text" name="telefono" class="form-control" required=""><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Celular</label><br>
					<input type="text" name="nro_Celular" class="form-control" required=""><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Dirección</label><br>
					<input type="text" name="direccion" class="form-control" required=""><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Ciudad</label><br>
					<input type="text" name="ciudad" class="form-control" required=""><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Departamento</label><br>
					<input type="text" name="departamento" class="form-control" required=""><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Tipo Persona</label><br>
					<select name="tipo_persona_tipo_persona" class="custom-select form-control" required="">
					<option value="true" selected disabled>Seleccione tipo Persona</option>
					<?php
						foreach ($tipoDocumentoPersona->consultarTipoPersona() as $dato) {
							echo '<option value="'.$dato->tipo_persona.'">'.$dato->nombre_tipo	.'</option>';
						}
					?>
					</select><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Estado</label><br>
					<select name="estado" class="custom-select form-control" required="">
						<option value="true" selected disabled>Seleccione estado</option>
						<option value="1">Activo</option>
						<option value="0">Inactivo</option>
					</select><br>
				</div>
			</div>
			<div class="col-md-12 mb-3">
			<input type="submit" id="registrar" name="registrar" class="btn btn-primary" value="Registrar" >
      <input type="reset" value="Limpiar" class="btn btn-secondary">
    	<a href="<?php echo SERVERURL; ?>listPerson"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
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
			if (isset($_POST["registrar"])) {
				$usuario->__SET('nombres', $_POST["nombres"]);
				$usuario->__SET('apellidos', $_POST["apellidos"]);
				$usuario->__SET('tipo_documento_tipo_documento', $_POST["tipo_documento_tipo_documento"]);
				$usuario->__SET('documento', $_POST["documento"]);
				$usuario->__SET('telefono', $_POST["telefono"]);
				$usuario->__SET('nro_Celular', $_POST["nro_Celular"]);
				$usuario->__SET('direccion', $_POST["direccion"]);
				$usuario->__SET('ciudad', $_POST["ciudad"]);
				$usuario->__SET('departamento', $_POST["departamento"]);
				$usuario->__SET('tipo_persona_tipo_persona', $_POST["tipo_persona_tipo_persona"]);
				$usuario->__SET('estado', $_POST["estado"]);

if (($usuario->nombres == "")&&($usuario->apellidos == "")&&($usuario->tipo_documento_tipo_documento == "")&&($usuario->documento == "")&&($usuario->telefono == "")&&($usuario->nro_Celular == "")&&($usuario->direccion == "")&&($usuario->ciudad == "")&&($usuario->departamento == "")&&($usuario->tipo_persona_tipo_persona == "")&&($usuario->estado == ""))  
		{
			 echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se púdo registrar el cliente Revise los campos.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="'.SERVERURL.'addPerson"; 
                                      });  
                                </script>';
                                return false;    
		}
	else if ($control->insertar($usuario)) {

                  echo'<script type="text/javascript"> 
                            swal({title: "LISTO",    
                                  text: "El cliente ha sido registrado correcto.", 
                                  type:"success", 
                                  confirmButtonText: "OK", 
                                  closeOnConfirm: false 
                                }, 
                                function(){ 
                                  window.location.href="'.SERVERURL.'listPerson"; 
                                });  
                          </script>'; 
                          }else{ 

                          echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se púdo registrar el cliente. Intenta más tarde.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="'.SERVERURL.'addPerson"; 
                                      });  
                                </script>';    
		?>
		<meta http-equiv="refresh" content="0; url=http://localhost:8080/SIR/listPerson">
<?php 
	}
} ?>

</div>