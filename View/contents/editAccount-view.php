<?php
  require_once 'Controller/user_controller.php';
  require_once 'Model/user_model.php';
$usuario = new Usuario();
$control = new User_Controller();
$resultado=$control->buscar('id_usuario');

$host="root";
$contraseña="";
$conexionbd = new PDO('mysql:host=localhost;dbname=s.i.r', $host, $contraseña);
$data = $conexionbd->query("SELECT * FROM tbl_usuario");
?>

<br>
<style type="text/css">
    .container{  
     width:1200px;
     height: 350px;
     display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
   }
</style>
<div class="container">
  <div class="col-md-6">
      <div class="panel panel-default">
          <div class="panel-heading clearfix">
             <span class="glyphicon glyphicon-edit fa-fax3 fa-lg"></span>
             <label ><h4><b>Editar Cuenta</b></h4></label>
          </div>
          <br>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4">
                <img class="img-circle img-size-2" src="<?php while ($row = $data->fetch()) {
       echo $row['url'];}?>" alt="">
            </div>
            <div class="col-md-8">
              <h5><label class="control-label">Seleccione una imagen</label></h5>
              <form class="form" action="upload" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <input type="file" name="img" class="btn btn-default btn-file" required="" />
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Cambiar">
              </div>
             </form>
             <br>
             </div>
          

             <form method="post" action="#" class="clearfix">
              <div class="form-row">
            <div class="col-md-6 mb-3">
                  <label for="name" class="control-label">Nombre</label>
                  <input type="name" class="form-control" name="nombre" value="<?php echo $resultado->nombre; ?>">  <br>
            </div>
            <div class="col-md-6 mb-3">
                  <label for="username" class="control-label">Correo</label>
                  <input type="email" class="form-control" name="correo" value="<?php echo $resultado->correo; ?>">  <br>
            </div>
            <div class="col-md-12 mb-3">
              <br>
                    <a href="<?php echo SERVERURL ?>changePassword" title="change password" class="btn btn-danger pull-right">Cambiar contraseña</a>
                    <input type="submit" name="enviar" class="btn btn-primary" value="Actualizar">
            </div>
          </div>
        </form>
        <br><br>
            </div>
          </div>
        </div>
  </div>
  </div>
</div>

  <?php 
if (isset($_POST['enviar'])) {
  $usuario->__SET('nombre',$_POST['nombre']);
  $usuario->__SET('correo',$_POST['correo']);

   if (($_POST["nombre"] =="")&&($_POST["correo"] == "")){
                echo "<script>swal('Error al editar cuenta','Campos Requeridos','error')</script>";
            }
            else if (($_POST["nombre"] =="")){
                echo "<script>swal('Error al editar cuenta','Campo Nombre Requerido','error')</script>";
            }
            else if (($_POST["correo"] =="")){
                echo "<script>swal('Error al editar cuenta','Campo Correo Requerido','error')</script>";
            }

  else if ($control->actualizar($usuario)) {
    echo'<script type="text/javascript"> 
                            swal({title: "LISTO",    
                                  text: "Cuenta Actualizada Correctamente.", 
                                  type:"success", 
                                  confirmButtonText: "OK", 
                                  closeOnConfirm: false 
                                }, 
                                function(){ 
                                  window.location.href="editAccount"; 
                                });  
                          </script>'; 
                          }
                          else{ 

                          echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se púdo actualizar la cuenta.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="editAccount"; 
                                      });  
                                </script>';    
    ?>
    <meta http-equiv="refresh" content="0; url=editAccount">
<?php 
  }
}else{

} ?>

