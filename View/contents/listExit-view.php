<?php
	// include_once ("../model/config.php");
	// $cnx = new conexion();
	// $cnx->conectar();

	require_once "Controller/exitController.php";
	$control = new exitController();
?>
<script>

$(document).ready(function() {
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
  width:950px;
  height: 400px;
  position: relative;
}

#modal_size{
  width: 25%;
}
</style>

    <center>

    <h1>Salidas</h1>
      </center>

         <div class="container">
          <hr>
          <a href="<?php echo SERVERURL; ?>addExit" class="btn btn-primary" role="button">Registrar Salida &nbsp&nbsp<i class="fa fa-plus-circle"></i></a>
         

          <a href="View/contents/reportExit-view.php" class="btn btn-primary" target="_blank" style="float: right;" role="button">Reporte &nbsp&nbsp<i class="fa fa-file"></i></a>
          <br><br>

       <div class="box-body table-responsive">
        <table id="grid" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
          <tr>
			<td scope="col">ID Salida</td>
			<td scope="col">Nombre Producto</td>
			<td scope="col">Referencia</td>
			<td scope="col">Cantidad</td>
			<td scope="col">Fecha Salida</td>
			<td scope="col">Tipo Salida</td>
			<td scope="col">Acciones</td>
		</tr>
		</thead>
		<tbody>
            <tr>
			<?php foreach ($control->listar() as $fila):?>
				<td scope="row"><?php echo $fila->Salida_id_salida; ?></td>
				<td><?php echo $fila->nombre_producto; ?></td>
				<td><?php echo $fila->referencia; ?></td>
				<td><?php echo $fila->cantidad; ?></td>
				<td><?php echo $fila->fecha_salida; ?></td>
				<td><?php echo $fila->tipo_salida_tipo_salida; ?></td>
				<td>
        <a href="edit-exit.php?id=<?php echo $fila->Salida_id_salida; ?>" title="Editar" class='btn btn-primary' >Editar <i class="fa fa-pencil-square-o" aria-hidden="true" ></i></a>

		</td>
            </tr>
      <?php endforeach; ?> 
        </tbody>

    </table>
</div>

<script>
        jQuery(document).ready(function($){
            $('.delete').on('click',function(){
                var getLink = $(this).attr('href');
                swal({
                        title: 'Estás seguro de eliminar este registro?',
                        text: "Será eliminado permanentemente!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, eliminar!',
                        closeOnConfirm: false
                        },function(){
                          swal("¡Eliminado!", 
                         "Eliminado Correctamente.", 
                         "success",); 
                        window.location.href = getLink
                    });
                return false;
            });
        });
    </script>