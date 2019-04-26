
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/login.css">
<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>public/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/iconmoon/style.css">
<link href="<?php echo SERVERURL; ?>public/css/sweetalert.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


<?php 
    include_once 'View/templates/link.php';
    include 'View/contents/includes/config1.php';
    include 'View/contents/includes/functionBD.php';
 ?>
    <section class="bienvenidos">
    <article id="particles-js" class="particulas-fondo"></article>
    <section class="contenedor" id="contenedor">
        <a href="index.php" class="volver"><span class="icon-arrow-left" id="atras"></span></a>
        <article class="login">


    <form class="forget-form" action="" method="post">
                <h3 class="font-green">¿Olvido Su Contraseña?</h3>
                <br>
                <h4>Ingrese su correo</h4>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix input-circle2" type="email" placeholder="Ingrese su correo" name="email" required />
                     </div>

                <div class="form-actions">
                    <input type="submit"  name="correo" class="btn btn-primary" value="Aceptar">
                     &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                     &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                     &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                     &nbsp&nbsp
                    <a href="<?php echo SERVERURL; ?>login"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
                
                </div>
                </form>
            </article>
        </section>



<?php
    $bd = new GestarBD;
 
if(isset($_POST["correo"])){

 if (($_POST["correo"] ==""))  
        {
             echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "Campo Requerido.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="recoverPassword"; 
                                      });  
                                </script>';                   
        }
            
                    $destino = $_POST['email'];
                //$cs=mysqli_query($sql,$conexion);
               
                $usuario = $bd->SelectText('*', 'tbl_usuario', "correo='$destino'",false,null,null);
                $bd->consulta($usuario);
                if ($mostrar = $bd->mostrar_registros()) {
                    $nombre= $mostrar->nombre;
                    $mail= $mostrar->correo;
                    $clave= $mostrar->password;
                    $correozippy="jhoanhenao820@gmail.com";
            
                    $casilla = 'jhoanhenao820@gmail.com';
                    $asunto = '';
                    $cabeceras = "From: "  .$correozippy.  "\r\n";
                    $cabeceras .= "Reply-To: ".$correozippy. "\r\n";
                    $cabeceras .= "MIME-Version: 1.0\r\n";
                    $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";

                    $mensaje = '<html><body>';
                    $mensaje .= '<p>Hola '. $nombre .' En el siguiente link puedes recuperar tu contraseña  </p>';
                    $mensaje .= 'http://localhost:8080/SIR/resetPassword';
                    $mensaje .= "</body></html>";
                    $para = "$mail";
                    $asunto = 'Recupera tu contraseña';
                    
                    
                  $correo = mail($para, $asunto, $mensaje, $cabeceras);

                
                  
                    if($correo){
                        echo'<script type="text/javascript"> 
                            swal({title: "LISTO",    
                                  text: "Se ha enviado al correo la recuperación de la contraseña.", 
                                  type:"success", 
                                  confirmButtonText: "OK", 
                                  closeOnConfirm: false 
                                }, 
                                function(){ 
                                  window.location.href="login"; 
                                });  
                          </script>'; 
                    }
                    else{
                   echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se pudo obtener los datos del correo '.$destino.'.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="recoverPassword"; 
                                      });  
                                </script>';
                }
                }
            
        }

        ?>




    <script src="public/js/particles.js"></script>
    <script src="public/js/particulas.js"></script>
    <script src="public/js/width.js"></script>
    <script src="public/iconmoon/selection.json"></script>


   