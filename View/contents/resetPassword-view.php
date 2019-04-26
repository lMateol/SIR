
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/login.css">
<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>public/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/iconmoon/style.css">
<link href="<?php echo SERVERURL; ?>public/css/sweetalert.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


<?php
 require_once 'Controller/user_controller.php';
  require_once 'Model/user_model.php';
$usuario = new Usuario();
$control = new User_Controller();
$resultado=$control->buscar('id_usuario');

?>

    <section class="bienvenidos">
    <article id="particles-js" class="particulas-fondo"></article>

<section class="contenedor" id="contenedor">
<a href="index.php" class="volver"><span class="icon-arrow-left" id="atras"></span></a>
        <article style="height: 410px;" class="login">
      <form method="post" action="#" class="forget-form">
        <br><br>
        <h3 class="font-green">¿Cambiar Contraseña?</h3>
              <br>
              <h4>Nueva Contraseña</h4>
              <div class="form-group">
              <input type="password" class="form-control" ID="txtPassword" name="password" placeholder="Nueva contraseña"><button style="height: 35px;"  id="show_password" class="btn btn-light" type="button" onclick="mostrarPassword()"><li style="color:black;" class="fa fa-eye-slash icon"></li></button>
              </div>

              <h4>Confirme Contraseña</h4>
               <div class="form-group">
              <input type="password" class="form-control" name="confirm" ID="txtPassword2" placeholder="Confirme Contraseña contraseña"><button style="height: 35px;"  id="show_password" class="btn btn-light" type="button" onclick="mostrarPassword2()"><li style="color:black;" class="fa fa-eye-slash iconn"></li></button>
        </div>
        <br>
        <div class="col-md-8 ">
              <input type="submit" name="enviar" class="btn btn-primary" value="Guardar">
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                  <a href="<?php echo SERVERURL?>login"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
        </div>
    </form>
</div>
</article>
</section>

<script src="public/js/particles.js"></script>
    <script src="public/js/particulas.js"></script>
    <script src="public/js/width.js"></script>
    <script src="public/iconmoon/selection.json"></script>

    <?php 
if (isset($_POST['enviar'])) {
  $usuario->__SET('password',MD5($_POST['password']));
  if(($_POST["password"])!==($_POST["confirm"])){
  
                echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "Las contraseñas no coinciden.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="resetPassword"; 
                                      });  
                                </script>';

           if (($_POST["password"] =="")&&($_POST["confirm"] == "")){
              echo "<script>swal('Error al cambiar la contraseña','Campos Requeridos','error')</script>";
          }

            
             else if (($_POST["password"] =="")){
                echo "<script>swal('Error al cambiar contraseña','Campo Nueva Contraseña Requerido','error')</script>";
            }
            else if (($_POST["confirm"] =="")){
                echo "<script>swal('Error al cambiar contraseña','Campo Confirme Contraseña Requerido','error')</script>";
            }           


  }else if ($control->actualizar1($usuario)) {
    echo'<script type="text/javascript"> 
                            swal({title: "LISTO",    
                                  text: "Contraseña Cambiada Correctamente,Inicia sesion con tu nueva contraseña.", 
                                  type:"success", 
                                  confirmButtonText: "OK", 
                                  closeOnConfirm: false 
                                }, 
                                function(){ 
                                  window.location.href="Login"; 
                                });  
                          </script>'; 
                          }
                          else{ 

                          echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se púdo actualizar la Entrada. Intenta más tarde.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="resetPassword"; 
                                      });  
                                </script>';    
    ?>
    <meta http-equiv="refresh" content="0; url=changePassword-view.php">
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





