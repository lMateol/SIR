<!--<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>public/css/bootstrap.min.css">
<link href="<?php echo SERVERURL; ?>public/css/sweetalert.css" rel="stylesheet" type="text/css">-->

<?php 
session_start();
error_reporting(0);
    $varsesion = $_SESSION['usu'];
    require_once 'controller/vistasController.php'; 
    $vt = new vistasController();
    $vtr = $vt->obtener_vistas_controlador();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo COMPANY; ?></title>
        
    <?php 
        include 'view/templates/script.php';
    ?>
</head>
<style>
    .contentPage{
        margin-top: 60px;
    }
</style>
<body>
    <?php 
       if($vtr=="login"):
        // require_once 'view/contents/homeAdmin-view.php';
        require_once 'view/contents/login-view.php';
        echo '<script src="'.SERVERURL.'public/js/particulas.js"></script> 
        <link rel="stylesheet" href="'.SERVERURL.'public/css/login.css">';
       else:
        if ($vtr=="./view/contents/recoverPassword-view.php" || $vtr=="./view/contents/resetPassword-view.php"|| $vtr=="./view/contents/Inicio-view.php"|| $vtr=="./view/contents/403-view.php"|| $vtr=="./view/contents/404-view.php"|| $vtr=="./view/contents/E403-view.php") {
            echo '<script src="'.SERVERURL.'public/js/particulas.js"></script>';
         require_once $vtr; 
        } else {
        
        if ($varsesion== null || $varsesion=='') {
            //echo 'NO TIENE AUTORIZACION';
          /*  echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No has iniciado sesión.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="'.SERVERURL.'Login"; 
                                      });  
                                </script>';*/
            header("location:E403");
            die();
        }
    ?>
<?php require_once 'view/templates/menu.php';
include 'view/templates/link.php';
 ?> 

    <section class="contentPage">
        <?php require_once $vtr; ?>
    </section>  
    <?php };endif; ?>   
    
</body>
</html>