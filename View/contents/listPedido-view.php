<?php 
require_once "Model/pedidoModel.php";
	//CONEXION
	$conec = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
	// set the PDO error mode to exception
	$conec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully"; 
  $datopedido=array();
	$consulta="SELECT * FROM tbl_pedido ORDER BY id_pedido ";
		$resultado=$conec->prepare($consulta);
		$resultado->execute();
		foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
			$pedido = new pedidoModel();
			$pedido->__SET('id_pedido',$datos->id_pedido);
			$pedido->__SET('Persona_id_persona',$datos->Persona_id_persona);
			$pedido->__SET('vendedor',$datos->vendedor);
			$pedido->__SET('fecha_pedido',$datos->fecha_pedido);
			$pedido->__SET('fecha_vencimiento',$datos->fecha_vencimiento);
			$pedido->__SET('despachado_por',$datos->despachado_por);
			$pedido->__SET('estado',$datos->estado);
			$datopedido[]=$pedido;
    }
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

    <h1>Pedidos</h1>
      </center>

         <div class="container">
           <hr>
          <a href="<?php echo SERVERURL; ?>addPedido" class="btn btn-primary" role="button">Registrar Pedido &nbsp&nbsp<i class="fa fa-plus-circle"></i></a>
          

          <br><br>

        <table id="grid" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
                <tr>
                        <!-- <td >Id Pedido</td> -->
                                <td >Id Cliente</td>
                                <td >Vendedor</td>
                                <td >Fecha Pedido</td>
                                <td >Fecha Vencimiento</td>
                                <td >Despachado Por</td>
                                <td >Estado</td>
                                <td >Acciones</td>
                </tr>
            </thead>

        <tbody>
            <tr>
      <?php foreach ($datopedido as $r):?>
      
                <!-- <td> <?php //echo $r->__GET('id_pedido'); ?> </td> -->
                <td> <?php echo $r->__GET('Persona_id_persona');?> </td>
                <td> <?php echo $r->__GET('vendedor'); ?> </td>
                                <td> <?php echo $r->__GET('fecha_pedido'); ?> </td>
                <td> <?php echo $r->__GET('fecha_vencimiento');?> </td>
                <td> <?php echo $r->__GET('despachado_por'); ?> </td>
                <td> <?php $estado = ($r->__GET('estado')==1) ? "Activo" : "Inactivo";  echo $estado; ?> </td>
                <td>
<a href="edit_pedido.php?id_pedido=<?php echo $r->id_pedido; ?>" title="Editar" class='btn btn-primary' ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i></a>

<a href="#" data-target="#miModal" data-toggle="modal" class='btn btn-primary' id='<?php echo $r->id_pedido; ?>'><i class="fa fa-eye" aria-hidden="true"></i></a> 

<a href="View/contents/voucherOrder-view.php?id_pedido=<?php echo $r->id_pedido; ?>" title="Comprobante" class="btn btn-primary" target="_blank" role="button"><i class="fa fa-file" aria-hidden="true"></i></a>

<!-- <a href="eliminar_pedido.php?id_pedido=<?php echo $r->id_pedido; ?>" title="Eliminar" class='btn btn-danger delete' ><i class="fa fa-trash-o" aria-hidden="true" ></i></a> -->

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
        <h4 class="modal-title" id="myModalLabel">Informacion Del Pedido</h4>
      </center>
      </div>
      <div class="modal-body">

               <label>Id Pedido:</label>
               <?php echo $r->__GET('vendedor'); ?> 
               <br>
               <label>Id Persona:</label>
               <?php echo $r->__GET('');?> 
               <br>Persona_id_persona
               <label>Vendador:</label>
               <?php echo $r->__GET('vendedor'); ?> 
               <br>
               <label>Fecha Pedido:</label>
               <?php echo $r->__GET('fecha_pedido'); ?> 
               <br>
               <label>Fecha Vencimiento:</label>
               <?php echo $r->__GET('fecha_vencimiento');?> 
               <br>
               <label>Despachado Por:</label>
               <?php echo $r->__GET('despachado_por'); ?> 
               <br>
               <label>Estado:</label>
               <?php echo $r->__GET('estado'); ?> 
              
               <div class="modal-footer">
                <center>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </center>
      </div>
      </div>
    </div>
  </div>
</div>
<?php
?>

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


  <script src="../../../Assets/js/table-datatables-responsive.js"></script>

</body>
</html>