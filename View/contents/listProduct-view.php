<?php 
require_once 'Controller/productController.php';
include_once 'Controller/categoryController.php';
require_once "Controller/personController.php";

$categoria = new CategoriaController();
$produtoController = new  productoController();
$person = new personController();
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
 width:1050px;
 height: 400px;
 position: relative;
}

</style>
    
    <center>
    <h1 style="margin-top:80px;">Productos</h1>
    </center>
    <div class="container">
       <hr>
     <br><a href="<?php echo SERVERURL; ?>addProduct" class="btn btn-primary" role="button">Agregar Nuevos Registros&nbsp&nbsp<i class="fa fa-plus-circle"></i></a>
     <!-- <a href="listar_pedido_detalle.php" class="btn btn-primary" role="button" style="font-family: 'Gill Sans','Gill Sans MT',sans-serif">Consultar Pedido Detalle</a> -->

     <a href="View/contents/reportProduct-view.php" class="btn btn-primary" target="_blank" style="float: right;" role="button">Reporte &nbsp&nbsp<i class="fa fa-file"></i></a>

      <br><br>
      <div class="box-body table-responsive">
        <table id="grid" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
                <tr>
                    <!--<td width="5%">Id Producto</td>-->
                    <td width="10%">Referencia</td>
                    <td width="10%">Nombre Producto</td>
                    <td width="1%">Precio Unitario</td>
                    <td width="1%">Iva Producto</td>
                    <td width="1%">Categoria</td> 
                    <td width="1%">Proveedor</td> 
                    <td width="1%">Cantidad</td> 
                    <td width="1%">Estado</td> 
                    <td width="1%">Acciones</td> 
                </tr>
            </thead>

        <tbody>
			<?php foreach ($produtoController->listar() as $r):?>
    		<tr estado="<?php echo $r->__GET('estado'); ?>" idProducto="<?php echo $r->__GET('id_producto'); ?>">
			<!--	<td> <?php echo $r->__GET('id_producto'); ?> </td>-->
				<td> <?php echo $r->__GET('referencia');?> </td>
                <td> <?php echo $r->__GET('nombre_producto');?> </td>
                <td> <?php echo $r->__GET('precio_unitario');?> </td>
                <td> <?php echo $r->__GET('IVA_Producto');?> </td>
                <td> <?php 
                $ca=$categoria->buscar($r->__GET('Categoria_Producto_id_Categoria'));
                echo $ca->__GET('categoria');
                ?>
                 </td>
                <td> <?php
                    $tipo=$person->buscar($r->__GET('Persona_id_persona'));
                    echo $tipo->__GET('nombres');
                ?> </td>
                <td> <?php echo $r->__GET('cantidad');?> </td>
                <td> <?php
                    if ($r->__GET('estado')==1) {
                        echo 'Activo';
                    }else {
                        echo "Inactivo";
                    }
                ?> </td>
                <td>
  <!-- <a href="edit_product.php?id_producto=<?php echo $r->id_producto; ?>" title="Editar" class='btn btn-primary' ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i></a> -->
  <!-- <a href="delete_product.php?id_producto=<?php echo $r->id_producto; ?>" title="Eliminar" class='btn btn-danger delete-link' ><i class="fa fa-trash-o" aria-hidden="true" ></i></a> -->
        <button class="btn btn-primary producto-editar text-center">Editar<i class="fa fa-pencil-square-o" aria-hidden="true"  style="margin-left: 10px;" ></i></button>
        <button class="btn btn-danger producto-cambiar text-center">Estado<i class="fas fa-sync-alt fa-spin" aria-hidden="true"  style="margin-left: 10px;" ></i></button>
				</td>
            </tr>
			<?php endforeach; ?> 
        </tbody>

    </table>
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
    $(document).on('click', '.producto-editar', function(){
      let element = $(this)[0].parentElement.parentElement;
      let id = $(element).attr('idProducto');
			VentanaCentrada('./View/contents/editProduct-view.php?id='+id,'Pedido','','1024','768','true');	
      });

        $(document).on('click', '.producto-cambiar', function(){
          let element = $(this)[0].parentElement.parentElement;
          let estado = $(element).attr('estado');
          let id = $(element).attr('idProducto');
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
              $.post('http://localhost:8080/SIR/Controller/productController.php', postData, function(response) {
                  console.log(response);
                  location.reload();
              });
          });  
      });
      
    </script>