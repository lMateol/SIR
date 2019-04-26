<?php
	// include_once ("../model/config.php");
	// $cnx = new conexion();
	// $cnx->conectar();

	require_once "Controller/personController.php";
	$control = new personController();

  
  //$controls = new personController();
  //$tipoDocumentoPersonModel= new tipoDocumentoPersonModel();
  //$resultados = $controls->buscar($_GET["id"]);
?>


<script>
$(document).ready(function() {
  responsive: true
  $('#grid').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });
});
</script>

<style type="text/css">
  .container 
 {  
 width:1050px;
 height: 400px;
 position: relative;
}

#modal_size
{
  width: 25%;
}
</style>
    <center>

    <h1>Personas</h1>
      </center>

         <div class="container">
          <hr>
          <a href="<?php echo SERVERURL; ?>addPerson" class="btn btn-primary" role="button">Registrar Persona &nbsp&nbsp<i class="fa fa-plus-circle"></i></a>
      <br><br>
        <table id="grid" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
		<tr>
			<!-- <td width="5%">ID</td> -->
			<td width="10%">Nombres</td>
			<!-- <td width="10%">Apellidos</td> -->
			<td width="10%">Tipo Documento</td>
			<td width="10%">Documento</td>
			<td width="10%">Teléfono</td>
			<!-- <td width="10%">Celular</td> -->
			<!-- <td width="10%">Dirección</td> -->
			<td width="10%">Ciudad</td>
			<!-- <td width="10%">Departamento</td> -->
			<td width="10%">Tipo Persona</td>
			<td width="10%">Estado</td>
			<td width="10%">Acciones</td>
		</tr>
	</thead>
	<tbody id="tablaCuerpo">
  <?php foreach ($control->listar() as $fila):
    ?>
		<tr estado="<?php echo $fila->numEstado; ?>" idPersona="<?php echo $fila->id_persona;  ?>">
				<!-- <td scope="row"><?php //echo $fila->id_persona; ?></td> -->
				<td><?php echo $fila->nombres; ?></td>
				<!-- <td><?php //echo $fila->apellidos; ?></td> -->
				<td><?php echo utf8_decode($fila->nombre_documento); ?></td>
				<td><?php echo utf8_decode($fila->documento); ?></td>
				<td><?php echo $fila->telefono; ?></td>
				<!-- <td><?php// echo $fila->nro_Celular; ?></td> -->
				<!-- <td><?php //echo  $fila->direccion; ?></td> -->
				<td><?php echo $fila->ciudad; ?></td>
				<!-- <td><?php //echo  $fila->departamento; ?></td> -->
				<td><?php echo $fila->nombre_tipo; ?></td>
				<td><?php echo $fila->estado; ?></td>
                <td>

				<!-- <a href="<?php //echo SERVERURL; ?>editPerson?id=<?php// echo $fila->id_persona; ?>" title="Editar" class='btn btn-primary' >Editar <i style="margin-left: 10px;" class="fa fa-pencil-square-o" aria-hidden="true" ></i></a> -->
        <button class="btn btn-primary persona-editar text-center">Editar<i class="fa fa-pencil-square-o" aria-hidden="true"  style="margin-left: 10px;" ></i></button>

        <a href="#" data-target="#miModal" data-toggle="modal" class='btn btn-primary' >Ver &nbsp<i class="fa fa-eye" aria-hidden="true"></i></a> 

        <button class="btn btn-danger persona-cambiar text-center">Estado<i class="fas fa-sync-alt fa-spin" aria-hidden="true"  style="margin-left: 10px;" ></i></button>
        <!-- <a href="<?php echo SERVERURL; ?>deletePerson?id=<?php echo $fila->id_persona; ?>" title="Eliminar" class='btn btn-danger delete' ><i class="fa fa-trash-o" aria-hidden="true" ></i></a> -->
        </td>
        </tr>
      <?php endforeach; ?> 
        </tbody>

    </table>
</div>



<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" id="modal_size">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <center>
        <h4 class="modal-title" id="myModalLabel">Información De La Persona</h4>
      </center>
      </div>
      <div class="modal-body">

        <table>
          <thead>
            <tr>
                 <td width="5%"></td>
                  <td width="2%"></td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>

              <label>Nombres:</label>
               <?php echo $fila->__GET('nombres'); ?>
               <br> 
               <label>Apellidos:</label>
               <?php echo $fila->__GET('apellidos'); ?> 
               <br>
               <label>Tipo Documento:</label>
               <?php echo $fila->__GET('nombre_documento'); ?> 
               <br>
               <label>Documento:</label>
               <?php echo $fila->__GET('documento'); ?> 
               <br>
               <label>Telefono:</label>
               <?php echo $fila->__GET('telefono'); ?> 
               <br>
               <label>Nro Celular:</label>
               <?php echo $fila->__GET('nro_Celular'); ?> 
               </td>
               <td>
               <label>Direccion:</label>
               <?php echo $fila->__GET('direccion'); ?> 
               <br>
               <label>Ciudad:</label>
               <?php echo $fila->__GET('ciudad'); ?> 
               <br>
               <label>Departamento:</label>
               <?php echo $fila->__GET('departamento'); ?> 
               <br>
               <label>Tipo Persona:</label>
               <?php echo $fila->__GET('nombre_tipo'); ?> 

               <label>Estado:</label>
               <?php echo $fila->__GET('estado'); ?> 
                </td>
            </tr>
          </tbody>
        </table>
              <br>
               <div class="modal-footer">
                <center>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </center>
      </div>
      </div>
    </div>
  </div>
</div>





	<script>
      function VentanaCentrada(theURL,winName,features, myWidth, myHeight, isCenter) { //v3.0
      if(window.screen)if(isCenter)if(isCenter=="true"){
        var myLeft = (screen.width-myWidth)/2;
        var myTop = (screen.height-myHeight)/2;
        features+=(features!='')?',':'';
        features+=',left='+myLeft+',top='+myTop;
      }
      window.open(theURL,winName,features+((features!='')?',':'')+'width='+myWidth+',height='+myHeight);
    }
    $(document).on('click', '.persona-editar', function(){
      let element = $(this)[0].parentElement.parentElement;
      let id = $(element).attr('idPersona');
			VentanaCentrada('./View/contents/editPerson-view.php?id='+id,'Pedido','','1024','768','true');	
      });

        $(document).on('click', '.persona-cambiar', function(){
          let element = $(this)[0].parentElement.parentElement;
          let estado = $(element).attr('estado');
          let id = $(element).attr('idPersona');
          const postData = {
              estado : estado,
              id : id,
          }
          swal({title: "LISTO",    
            text: "El estado ha sido editado correctamente.", 
            type:"success", 
            confirmButtonText: "OK", 
            closeOnConfirm: true 
          }, 
          function(){ 
              $.post('http://localhost:8080/SIR/Controller/personController.php', postData, function(response) {
                  console.log(response);
                  location.reload();
              });
          });  
      });
      
// FORMA DE HACER ELIMINAR CON OTRA ALERTA
        // jQuery(document).ready(function($){
        //     $('.delete').on('click',function(){
        //         var getLink = $(this).attr('href');
        //         let element = $(this)[0].parentElement.parentElement;
        //   let estado = $(element).attr('estado');
        //   let id = $(element).attr('idPersona');
        //   const postData = {
        //       estado : estado,
        //       id : id,
        //   }
        //         swal({
        //                 title: 'Estás seguro de eliminar este registro?',
        //                 text: "Será eliminado permanentemente!",
        //                 type: 'warning',
        //                 showCancelButton: true,
        //                 confirmButtonColor: '#3085d6',
        //                 cancelButtonColor: '#d33',
        //                 confirmButtonText: 'Si, eliminar!',
        //                 closeOnConfirm: false
        //                 },
        //                 function(){
        //                   swal("¡Eliminado!", 
        //                  "Eliminado Correctamente.", 
        //                  "success",); 
        //                  $.post('http://localhost/SIR/Controller/personController.php', postData, function(response) {
        //       });
        //             });
        //         return false;
        //     });
        // });
    </script>
		<!--<meta http-equiv="refresh" content="0; url=http://localhost:8080/SIR/listPerson">