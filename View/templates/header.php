<?php  

$control = new User_Controller();
$resultado=$control->buscar('id_usuario');

$host="root";
$contraseña="";
$conexionbd = new PDO('mysql:host=localhost;dbname=s.i.r', $host, $contraseña);
$data = $conexionbd->query("SELECT * FROM tbl_usuario");
 ?>
      
      <div class="pull-left clearfix">
        <ul class="info-menu list-inline list-unstyled">
          <li class="profile">
            <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
              &nbsp&nbsp&nbsp&nbsp&nbsp<img class="img-circle img-inline" src="<?php while ($row = $data->fetch()) {
       echo $row['url'];}?>" alt="">

              <span><?php echo $resultado->nombre; ?><i class="caret"></i></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                       <a href="<?php echo SERVERURL; ?>profile" title="edit account">
                      <i class="glyphicon glyphicon-user"></i>
                      Perfil
                  </a>
              </li>
             <li>
                 <a href="<?php echo SERVERURL; ?>editAccount" title="edit account">
                     <i class="glyphicon glyphicon-cog"></i>
                     Configuración
                 </a>
             </li>
             <li class="last">
                 <a href="<?php echo SERVERURL; ?>logout">
                     <i class="glyphicon glyphicon-off"></i>
                     Salir
                 </a>
             </li>
           </ul>
          </li>
        </ul>
      </div>
     </div>