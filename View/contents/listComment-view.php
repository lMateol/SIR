<?php 
require_once "Controller/sugerenciaController.php";
$controls = new  comentarioController();
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
 width:800px;
 height: 400px;
 position: relative;
}

#modal_size{
      width: 25%;
    }

    </style>
    <center>
    <h1>Mensajes</h1>
  </center>
     <div class="container">
      <hr>

     <!-- <a href="listar_pedido_detalle.php" class="btn btn-primary" role="button" style="font-family: 'Gill Sans','Gill Sans MT',sans-serif">Consultar Pedido Detalle</a> -->
      <div class="box-body table-responsive">
        <table id="grid" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
                <tr>
                  <td width="5%">Nombre</td>
                  <td width="5%">Correo</td>
                  <td width="5%">Telefono</td>
                  <td width="5%">Comentario</td>
                  <td width="5%">Fecha</td>
                  <td width="1%">Acciones</td>
                </tr>
            </thead>

        <tbody>
            <tr>
			<?php foreach ($controls->ListaDatos() as $r):?>
								<td> <?php echo $r->__GET('nombre');?> </td>
                <td> <?php echo $r->__GET('correo');?> </td>
                <td> <?php echo $r->__GET('telefono');?> </td>
                <td> <?php echo $r->__GET('comentario');?> </td>
                <td> <?php echo $r->__GET('fecha');?> </td>
                <td>
<a href="view/contents/deleteComment-view.php?id=<?php echo $fila->id_comentario; ?>" title="Eliminar" class='btn btn-danger delete' >Eliminar <i class="fa fa-trash-o" aria-hidden="true" ></i></a>
								</td>
            </tr>
			<?php endforeach; ?> 
        </tbody>

    </table>
</div>
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

</body>
</html>