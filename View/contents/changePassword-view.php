 
<?php
  require_once 'Controller/user_controller.php';
  require_once 'Model/user_model.php';
$usuario = new Usuario();
$control = new User_Controller();
$resultado=$control->buscar('id_usuario');
?>
<br><br>
<style type="text/css">
    .container{  
     width:1370px;
     height: 350px;
     display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
   }

   
</style>
<div class="container">
  <div class="col-md-6">
  </div>
  <br>
  <div class="col-md-6">
      <div class="panel panel-default">
          <div class="panel-heading clearfix">
             <span class="glyphicon glyphicon-edit fa-fax3 fa-lg"></span>
             <label ><h4><b>Cambiar Contraseña</b></h4></label>
          </div>
          <br>
      <div class="panel-body">    
      <form method="post" action="#" >
         <div class="form-row">
         <div class="col-md-6 mb-3" style="display: flex;">
              <label for="oldPassword" class="control-label">Antigua contraseña</label>&nbsp
              <input style="border-right:0;" type="password" ID="txtPassword" class="form-control" name="old-password" placeholder="Antigua contraseña"><button style="height: 35px; border-left:0;"id="show_password" class="btn btn-light" type="button" onclick="mostrarPassword()"><li style="color:black;" class="fa fa-eye-slash icon"></li></button>  
        </div> 

        <div class="col-md-6 mb-3" style="display: flex;">
          <label for="newPassword" class="control-label">Nueva contraseña</label>&nbsp
              <input style="border-right:0;" type="password" class="form-control" name="password" ID="txtPassword2" placeholder="Nueva Contraseña"><button style="height: 35px;"  id="show_password" class="btn btn-light" type="button" onclick="mostrarPassword2()" ><li style="color:black;" class="fa fa-eye-slash iconn"></li></button>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div class="col-md-12 mb-3">
                 <input type="submit" name="enviar" class="btn btn-primary" value="Actualizar">
                <input type="reset" value="Limpiar" class="btn btn-secondary">
                  <a href="<?php echo SERVERURL ?>editAccount"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
        </div>
      </div>
    </div>
     <br>
    </form>
    </div>
</div>
</div>
</div>


  <?php 
if (isset($_POST['enviar'])) {
  $usuario->__SET('password',MD5($_POST['password']));
  if(MD5($_POST['old-password']) !== ($resultado->password)){
                echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "Tu contraseña antiagua no es correcta.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="changePassword"; 
                                      });  
                                </script>';  

          if (($_POST["password"] =="")&&($_POST["old-password"] == "")){
              echo "<script>swal('Error al cambiar la contraseña','Campos Requeridos','error')</script>";
          }
          else if (($_POST["password"] =="")){
              echo "<script>swal('Error al cambiar la contraseña','Campo Nueva Contraseña Requerido','error')</script>";
          }
          else if (($_POST["old-password"] =="")){
              echo "<script>swal('Error al iniciar sesión','Campo Antigua Contraseña Requerido','error')</script>";
          }  


  }else if ($control->actualizar1($usuario)) {
    echo'<script type="text/javascript"> 
                            swal({title: "LISTO",    
                                  text: "Contraseña Actualizada Correctamente,Inicia sesion con tu nueva contraseña.", 
                                  type:"success", 
                                  confirmButtonText: "OK", 
                                  closeOnConfirm: false 
                                }, 
                                function(){ 
                                  window.location.href="login"; 
                                });  
                          </script>';
                          session_unset(); 
                          session_destroy(); 
                          }
                          else{ 

                          echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se púdo actualizar la contraseña. Intenta más tarde.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="login"; 
                                      });  
                                </script>';    
    ?>
    <meta http-equiv="refresh" content="0; url=login-view.php">
<?php 
  }
}else{

} ?>


<script>
    function mostrarPassword(){
        var cambio = document.getElementById("txtPassword");
        if(cambio.type == "password"){
            cambio.type = "text";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }else{
            cambio.type = "password";
            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    } 

    function mostrarPassword2(){
        var cambios = document.getElementById("txtPassword2");
        if(cambios.type == "password"){
            cambios.type = "text";
            $('.iconn').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }else{
            cambios.type = "password";
            $('.iconn').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    } 
    
</script>
