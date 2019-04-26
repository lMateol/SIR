<?php
  require_once 'Controller/user_controller.php';
  require_once 'Model/user_model.php';

$control = new User_Controller();
$resultado=$control->buscar('id_usuario');

$host="root";
$contraseña="";
$conexionbd = new PDO('mysql:host=localhost;dbname=s.i.r', $host, $contraseña);
$data = $conexionbd->query("SELECT * FROM tbl_usuario");
?>
  
<br><br><br>

<style type="text/css">
    .container{  
     width:500px;
     height: 315px;
   }
</style>

<center>
  <div class="container">

       <div class="panel profile">
         <div class="jumbotron text-center bg-blue">
             <img class="img-circle img-size-2" src="<?php while ($row = $data->fetch()) {
       echo $row['url'];}?>" alt="">
       <h3 style="color: black;"><?php echo $resultado->nombre; ?> </h3>
       <br>
       <br>
      
         <ul class="nav nav-pills nav-stacked">
          <li><a href="<?php echo SERVERURL ?>editAccount"> <i class="glyphicon glyphicon-edit fa-fax3 fa-lg"></i><label ><h4><b>Editar Perfil</b></h4></label></a></li>
         </ul>
       
       </div>
   </div>
</center>
</div>