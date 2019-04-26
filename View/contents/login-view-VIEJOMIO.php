<?php 
require_once './Controller/controller_login.php';
$control= new IniciarSesion();
 ?>

<body>
    <section class="bienvenidos">

    <article id="particles-js" class="particulas-fondo"></article>
    <section class="contenedor" id="contenedor">
        <a href="../../Homepage/inicio.php" class="volver"><span class="icon-arrow-left" id="atras"></span></a>
        <article class="login">
          <img class="img1" src="./public/img/Rodillos GBP.PNG" alt="">
          <h3>Iniciar sesión</h3>
           <form method="post" action="#" class="clearfix">
            <div><span class="icon-user"></span><input class="inp" type="text" name="user" require></div>

            <div><span class="icon-key"></span><input ID="txtPassword" class="inp" type="password" name="pass" require>&nbsp&nbsp<li class="fa fa-eye-slash icon" onclick="mostrarPassword()"></li></div>
           
            <input class="boton" type="submit" name="enviar" value="Iniciar Sesión">
          </form>
          <br>
          <a href="recoverPassword/" id="forget-password" class="forget-password">¿Olvido su Contraseña?</a>
          <br>
        </article>
    </section>
</section>

<?php 
if (isset($_POST['enviar'])) {
    $usu=$_POST['user'];
$pass=$_POST['pass'];
if (($usu == "")&&($pass == "")){
    echo "<script>swal('Error al iniciar sesión','Campos Requeridos','error')</script>";
}
if (($usu == "")){
    echo "<script>swal('Error al iniciar sesión','Campo Correo Requerido','error')</script>";
}
else if (($pass == "")){
    echo "<script>swal('Error al iniciar sesión','Campo Contraseña Requerido','error')</script>";
}
else if ($control->iniciar($usu,$pass)) {
    //echo("<script>alert('iniciando sesion')</script>");
}else{

echo "<script>swal('Error al iniciar sesión','contraseña y/o correo no coinciden, intente de nuevo','error')</script>";

 }


}

 ?>
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
    
    $(document).ready(function () {
    //CheckBox mostrar contraseña
    $('#ShowPassword').click(function () {
        $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
    });
});
</script>