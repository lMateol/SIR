<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<?php
	require_once "../../Model/personModel1.php";
	require_once "../../Model/tipoDocumento_Persona_model.1.php";
	$usuario = new  personModel1();
	$tipoDocumentoPersonModel= new tipoDocumentoPersonModel1();
	//CONEXION
	$conec = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
	// set the PDO error mode to exception
	$conec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// echo "Connected successfully"; 
			$resultado;
			$buscar  = "SELECT * FROM tbl_persona WHERE id_persona=?";
				$resultado = $conec->prepare($buscar);
				$resultado->execute(array($_GET["id"]));

				$datos = $resultado->fetch(PDO::FETCH_OBJ);
				$usuario = new personModel1();
				$usuario->__SET('id_persona', $datos->id_persona);
				$usuario->__SET('nombres', $datos->nombres);
				$usuario->__SET('apellidos', $datos->apellidos);
				$usuario->__SET('tipo_documento_tipo_documento', $datos->tipo_documento_tipo_documento);
				$usuario->__SET('documento', $datos->documento);
				$usuario->__SET('telefono', $datos->telefono);
				$usuario->__SET('nro_Celular', $datos->nro_Celular);
				$usuario->__SET('direccion', $datos->direccion);
				$usuario->__SET('ciudad', $datos->ciudad);
				$usuario->__SET('departamento', $datos->departamento);
				$usuario->__SET('tipo_persona_tipo_persona', $datos->tipo_persona_tipo_persona);
				$usuario->__SET('estado', $datos->estado);	

				$resultado = $usuario;

?>
<style type="text/css">
   .container{  
    width:900px;
    height: 575px;
  }
</style>
     <br>
	<div class="container">
		<div class="col-md-16">
      <div class="panel panel-default">
          <div class="panel-heading clearfix">&nbsp&nbsp
             <span class="glyphicon glyphicon-edit fa-fax3 fa-lg"></span>
             <label ><h4><b>Editar Persona</b></h4></label>
          </div>
      <div class="panel-body"> 
		<form action="" method="POST" class="ml-2" id="validate_form">
			<div class="form-row">
					<input type="hidden" name="id_persona" class="form-control" disabled="" value="<?php echo $resultado->id_persona ?>">
				<div class="col-md-4 mb-3">
					<label>Nombres</label>
					<input type="text" name="nombres" class="form-control" required="" value="<?php echo $resultado->nombres ?>">
				</div>
				<div class="col-md-4 mb-3">
					<label>Apellidos</label>
					<input type="text" name="apellidos" class="form-control" required="" value="<?php echo $resultado->apellidos ?>">
				</div>
				<div class="col-md-4 mb-3 form-group">
					<!-- <label>Tipo Documento</label><br>
					<select name="tipo_documento_tipo_documento" class="custom-select">
					<option value="true" disabled>seleccionar tipo documento</option>
						<?php
							// if ($resultado->tipo_documento_tipo_documento==1) {
							// 	echo '<option value="1" selected>Cedula Ciudadania</option>
							// 	<option value="2">Tarjeta Identidad</option>
							// 	<option value="3">Cedula Ciudadania</option>
							// 	<option value="4">Tarjeta Identidad</option>
							// 	<option value="5">Registro Civil</option>';
							// }elseif ($resultado->tipo_documento_tipo_documento==2) {
							// 	echo '<option value="1">Cedula Ciudadania</option>
							// 	<option value="2" selected>Tarjeta Identidad</option>
							// 	<option value="3">selected>Cedula Ciudadania</option>
							// 	<option value="4">Tarjeta Identidad</option>
							// 	<option value="5">Registro Civil</option>';
							// }elseif ($resultado->tipo_documento_tipo_documento==3) {
							// 	echo '<option value="1">Cedula Ciudadania</option>
							// 	<option value="2">Tarjeta Identidad</option>
							// 	<option value="3" selected>Cedula Ciudadania</option>
							// 	<option value="4">Tarjeta Identidad</option>
							// 	<option value="5">Registro Civil</option>';
							// }elseif ($resultado->tipo_documento_tipo_documento==4) {
							// 	echo '<option value="1">Cedula Ciudadania</option>
							// 	<option value="2">Tarjeta Identidad</option>
							// 	<option value="3">selected>Cedula Ciudadania</option>
							// 	<option value="4"selected>Tarjeta Identidad</option>
							// 	<option value="5">Registro Civil</option>';
							// }elseif ($resultado->tipo_documento_tipo_documento==5) {
							// 	echo '<option value="1">Cedula Ciudadania</option>
							// 	<option value="2">Tarjeta Identidad</option>
							// 	<option value="3" >selected>Cedula Ciudadania</option>
							// 	<option value="4">Tarjeta Identidad</option>
							// 	<option value="5"selected>Registro Civil</option>';
							// }
						?>
					</select>
					<br><br> -->
					<label>seleccionar tipo documento</label>
					<select name="tipo_documento_tipo_documento" class="custom-select form-control" placeholder="Seleccione Estado"  required ="">
            <option value="true" disabled>Seleccione tipo</option>
            <?php
						$tipoDocumento = array();
						$consultar = "SELECT * FROM tbl_tipo_documento";
							$resultadoTipo = $conec->query($consultar);
			
							foreach ($resultadoTipo->fetchAll(PDO::FETCH_OBJ) as $dato) {
								$tipo = new tipoDocumentoPersonModel1();
								$tipo->__SET('tipo_documento', $dato->tipo_documento);
								$tipo->__SET('nombre_documento', $dato->nombre_documento);
			
								$tipoDocumento[] = $tipo;
							}
					
              foreach ($tipoDocumento as $dat) {
                  if ($dat->tipo_documento==$resultado->tipo_documento_tipo_documento) {
									echo '<option value="'.$resultado->tipo_documento_tipo_documento.'"selected>'.$dat->nombre_documento.'</option>';
                }else{
									echo '<option value="'.$dat->tipo_documento.'">'.$dat->nombre_documento.'</option>';
								}
							}
            ?>
          </select>
					
				</div>
				<div class="col-md-4 mb-3">
					<label>Documento</label><br>
					<input type="text" name="documento" class="form-control" required="" value="<?php echo $resultado->__GET('documento') ?>"><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Teléfono</label><br>
					<input type="text" name="telefono" class="form-control" required="" value="<?php echo $resultado->telefono ?>"><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Celular</label><br>
					<input type="text" name="nro_Celular" class="form-control" required="" value="<?php echo $resultado->nro_Celular ?>"><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Dirección</label><br>
					<input type="text" name="direccion" class="form-control" required="" value="<?php echo $resultado->direccion ?>"><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Ciudad</label><br>
					<input type="text" name="ciudad" class="form-control" required="" value="<?php echo $resultado->ciudad ?>"><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Departamento</label><br>
					<input type="text" name="departamento" class="form-control" required="" value="<?php echo $resultado->departamento ?>"><br>
				</div>
				<div class="col-md-4 mb-3">
							<!-- forma larga y estudipa -->
					<!-- <label>Tipo Persona</label><br>
					<select name="tipo_persona_tipo_persona" class="custom-select" required="">
						<option value="true" disabled>seleccionar tipo persona</option>
						<?php
							// if ($resultado->tipo_persona_tipo_persona==1) {
							// 	echo '<option value="1" selected>Proveedor</option>
							// 	<option value="2">Cliente</option>
							// 	<option value="3">jouler</option>';
							// }elseif ($resultado->tipo_persona_tipo_persona==2) {
							// 	echo '<option value="1">Proveedor</option>
							// 	<option value="2"selected>Cliente</option>
							// 	<option value="3">jouler</option>';
							// }elseif ($resultado->tipo_persona_tipo_persona==3) {
							// 	echo '<option value="1">Proveedor</option>
							// 	<option value="2">Cliente</option>
							// 	<option value="3"selected>jouler</option>';
							// }
						?>
					</select><br> -->
					<label>Tipo Persona</label><br>
					<select name="tipo_persona_tipo_persona" class="custom-select form-control" placeholder="Seleccione Tipo"  required ="">
            <option value="true" disabled>Seleccione tipo</option>
            <?php
						$tipoPersona = array();
						$consultar = "SELECT * FROM tbl_tipo_persona";
						$resultadoTipoP = $conec->query($consultar);
							
						foreach ($resultadoTipoP->fetchAll(PDO::FETCH_OBJ) as $dato) {
							$tipo = new tipoDocumentoPersonModel1();
							$tipo->__SET('tipo_persona', $dato->tipo_persona);
							$tipo->__SET('nombre_tipo', $dato->nombre_tipo);
							$tipoPersona[]=$tipo;
						}
            foreach ($tipoPersona as $dat) {
              if ($dat->tipo_persona==$resultado->tipo_persona_tipo_persona) {
								echo '<option value="'.$resultado->tipo_persona_tipo_persona.'"selected>'.$dat->nombre_tipo.'</option>';
              }else{
								echo '<option value="'.$dat->tipo_persona.'">'.$dat->nombre_tipo.'</option>';
							}
						}
            ?>
          </select><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Estado</label><br>
					<select name="estado" class="custom-select form-control" required="">				
						<option value="true" disabled>seleccionar estado</option>
						<?php
							if ($resultado->estado==1) {
								echo '<option value="1" selected>Activo</option>
								<option value="2">Inactivo</option>';
							}elseif ($resultado->estado==0) {
								echo '<option value="1">Activo</option>
								<option value="2"selected>Inactivo</option>';
							}
						?>
					</select><br>
				</div>
			</div>
			<div class="col-md-12">
				<input type="submit" name="actualizar" class="btn btn-primary" value="Actualizar">
				<input type="reset" value="Limpiar" class="btn btn-secondary">
				<!-- <button type="submit" class="categoria-cancelar">Cancelar</button> -->
    		<a href="http://localhost:8080/SIR/listPerson"><input type="button" value="Cancelar" class="btn btn-danger"  style="float: right;"></a>
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


		<script>  
		$(document).on('click', '.categoria-cancelar', function(){
		 window.close();
    });
        $(document).ready(function(){  
		 window.close();
			 
       });  
       </script>

		<?php
			if (isset($_POST["actualizar"])) {
				$respuesta;
				$usuario->__SET('id_persona', $_GET["id"]);
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

				$insertar = "UPDATE tbl_persona SET nombres=?, apellidos=?, tipo_documento_tipo_documento=?, documento=?, telefono=?, nro_Celular=?, direccion=?, ciudad=?, departamento=?, tipo_persona_tipo_persona=?, estado=? WHERE id_persona=?";
				try{
					$conec->prepare($insertar)->execute(array(
						$usuario->__GET('nombres'),
						$usuario->__GET('apellidos'),
						$usuario->__GET('tipo_documento_tipo_documento'),
						$usuario->__GET('documento'),
						$usuario->__GET('telefono'),
						$usuario->__GET('nro_Celular'),
						$usuario->__GET('direccion'),
						$usuario->__GET('ciudad'),
						$usuario->__GET('departamento'),
						$usuario->__GET('tipo_persona_tipo_persona'),
						$usuario->__GET('estado'),
						 $_GET["id"]
					));
					echo'<script>confirm("PERSONA ACTUALIZADA")</script>';
				}catch (Exception $e){
					echo "Error al buscar datos ".$e->getMessage();
					echo'<script>confirm("ERRROR ACTUALIZAR")</script>';
				}
}
 ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../public/js/jquery.js"></script>
  <script src="../../public/js/sweetalert.min.js"></script>                
  <script src="../../public/js/sweetalert-dev.js"></script>   
 </div>