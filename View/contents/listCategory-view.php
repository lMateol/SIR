<?php 
require_once "Controller/categoryController.php";
$controls = new  CategoriaController();
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
    <h1>Categorías</h1>
  </center>
     <div class="container">
      <hr>
          <a href="<?php echo SERVERURL; ?>addCategory" class="btn btn-primary" role="button">Registrar Categoria &nbsp&nbsp<i class="fa fa-plus-circle"></i></a>
     <br><br>

     <!-- <a href="listar_pedido_detalle.php" class="btn btn-primary" role="button" style="font-family: 'Gill Sans','Gill Sans MT',sans-serif">Consultar Pedido Detalle</a> -->
      <div class="box-body table-responsive">
        <table id="grid" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
                <tr>
                  <td width="5%">Nombre Categoría</td>
                  <td width="5%">Estado</td>
                  <td width="1%">Acciones</td>
                </tr>
            </thead>

        <tbody>

			<?php foreach ($controls->ListaDatos() as $r):?>
        <tr estado="<?php echo $r->__GET('estado'); ?>" idCategoria="<?php echo $r->__GET('id_Categoria'); ?>">
								<td> <?php echo $r->__GET('categoria');?> </td>
                <td>
                  <?php
                    if ($r->__GET('estado')==1) {
                      echo "Activo";
                    }else{
                      echo "Inactivo";
                    }
                   ?> 
                 </td>
                <td>
<button class="btn btn-primary categoria-editar text-center">Editar<i class="fa fa-pencil-square-o" aria-hidden="true"  style="margin-left: 10px;" ></i></button>
<button class="btn btn-danger categoria-cambiar text-center">Estado<i class="fas fa-sync-alt fa-spin" aria-hidden="true"  style="margin-left: 10px;" ></i></button>
								</td>
            </tr>
			<?php endforeach; ?> 
        </tbody>

    </table>
</div>
</div>
<script type="text/javascript">

  function VentanaCentrada(theURL,winName,features, myWidth, myHeight, isCenter) { //v3.0
      if(window.screen)if(isCenter)if(isCenter=="true"){
        var myLeft = (screen.width-myWidth)/2;
        var myTop = (screen.height-myHeight)/2;
        features+=(features!='')?',':'';
        features+=',left='+myLeft+',top='+myTop;
      }
      window.open(theURL,winName,features+((features!='')?',':'')+'width='+myWidth+',height='+myHeight);
    }
    $(document).on('click', '.categoria-editar', function(){
      let element = $(this)[0].parentElement.parentElement;
      let id = $(element).attr('idCategoria');
      VentanaCentrada('./View/contents/editCategory-view.php?id='+id,'Pedido','','1024','768','true'); 
      });

  $(document).on('click', '.categoria-cambiar', function(){
          let element = $(this)[0].parentElement.parentElement;
          let estado = $(element).attr('estado');
          let id = $(element).attr('idCategoria');
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
              $.post('http://localhost:8080/SIR/Controller/categoryController.php', postData, function(response) {
                  console.log(response);
                  location.reload();
              });
          });  
      });
</script>


</body>
</html>