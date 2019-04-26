<?php

include_once "Model/config.php";
include_once "Model/userModel.php";

class UsuarioController extends Conexion
{   

    public function validar(){
        session_start();
        if (isset($_POST['user']) && isset($_POST['pass'])){
           $usuario = $_POST['user'];
           $clave = hash('sha1',$_POST['pass']);
           try{
               //consulta
               $stmt = $this->conexion->prepare("SELECT * FROM usuario WHERE email='$usuario' AND password='$clave'"); 
               $stmt->execute();
               //mostramos datos
               $datos = $stmt->fetch();
               echo var_dump($stmt);
               while( $datos = $stmt->fetch() ){
                $_SESSION['nombreusu']=$datos[1];   }
                   // miramos si trajo registro y cuantos (si el usuario existe)
               $count=$stmt->rowCount();
               if($count){
                   // consultamos el tipo
                   $result = $this->conexion->prepare("SELECT IDTipo_usua FROM usuario WHERE email='$usuario' AND password='$clave'"); 
                   $result->execute();
                   //almacenamos el tipo en una variable y en una variable de session
                   while( $datos = $result->fetch() ){
                   $tipo=$datos[0].'<br/>';}
                   $_SESSION['usuario']=$tipo;
                   if ($tipo==1) {
                       header("location:vista-admin.php");
                   }elseif($tipo==2){
                       header("location:vista-usuario.php");
                   }else{echo'error';}
               
               }else{
                echo '<script>confirm("Error autenficicación")</script>;';
               } 
               $conn=null;
           }
           catch(PDOException $e) {
               echo "Error: " . $e->getMessage();
           }
   } 
    }
   public function Listar()
   {
       $datosUsuario=array();
       $consulta= "SELECT * FROM usuario";
       try {
           $resultado = $this->conexion->query($consulta);
           //$resultado->execute();
           
           foreach ($resultado-> FetchAll(PDO::FETCH_OBJ) as $dato) {
               $usuario = new UsuarioModel();
               $usuario->__SET('cedula',$dato->cedula);
               $usuario->__SET('nombre',$dato->nombre);
               $usuario->__SET('email',$dato->email);
               $usuario->__SET('usuario',$dato->IDTipo_usua);
               $usuario->__SET('password',$dato->password);

               $datosUsuario[]=$usuario;
           }
           return $datosUsuario;
       } catch (Exception $e) {
           echo "Error al consultar: ".$e->getMessage();
       }
   }
/*
 public function userExist($email, $pass)
{
    $datosUsuario=array();
    $query = $this->conexion->prepare('SELECT IDTipo_usua FROM usuario WHERE email = :email AND password = :password');
    try{ 
       
        $query->execute(); 
        var_dump($query);
        $count=$query->rowCount();
        $data=$query->fetch(PDO::FETCH_OBJ);
        if($count){
        $_SESSION['email']=$data->$email;
        return true;
        }else{
        return false;
        } 

} catch (Exception $e) {
echo "Error al consultar: ".$e->getMessage();
}
    
} */

   public function Insertar(UsuarioModel $usuario)
   {
       $insertar= "INSERT INTO usuario (cedula,nombre, email, IDTipo_usua, password) VALUES (?,?,?,?,?)";
       try {
           $this->conexion->prepare($insertar)->execute(array(
           $usuario->__GET('cedula'),
           $usuario->__GET('nombre'),
           $usuario->__GET('email'),
           $usuario->__GET('usuario'),
           $usuario->__GET('password')

           ));
           return true;
       } catch (Exception $e) {
           echo "Error al insertar datos: ".$e->getMessage();
       }
   }

   public function Buscar($id)
   {
   $buscar= "SELECT * FROM usuario WHERE id=?";
   try {
       $resultado=$this->conexion->prepare($buscar);
       $resultado->execute(array($id));

       $datos=$resultado->fetch(PDO::FETCH_OBJ);
       $usuario = new UsuarioModel();
       $usuario->__SET('id',$datos->id);
       $usuario->__SET('nombre',$datos->nombre);
       $usuario->__SET('edad',$datos->edad);
       $usuario->__SET('email',$datos->email);

       return $usuario;

   } catch (Exception $e) {
       echo "Error al buscar datos: ".$e->getMessage();
   }
}
/*
   public function Actualizar(UsuarioModel $usuario)
   {
       $insertar="UPDATE usuario SET nombre=?, edad=?, email=? WHERE id=?";
       try {
           $this->conexion->prepare($insertar)->execute(array(
            $usuario->__GET('nombre'),
            $usuario->__GET('edad'),
            $usuario->__GET('email'),
            $usuario->__GET('id')
           ));
           return true;
        } catch (Exception $e) {
            echo "Error al actualizar datos: ".$e->getMessage();
        }
   }*/

   public function Eliminar($id)
   {
       $borrar= "DELETE FROM usuario WHERE cedula=?";
       try {
           $this->conexion->prepare($borrar)->execute(array($id));
           return true;

} catch (Exception $e) {
    echo "Error al actualizar datos: ".$e->getMessage();
}
   }

private $nombre;
private $username;


public function setUser($email)
{
    $query = $this->conexion->prepare('SELECT * FROM usuario WHERE email = :email');
    $query->execute(['email' => $email]);

    foreach ($query as $currentUser) {
        $this->nombre = $currentUser['nombre'];
        $this->username = $currentUser['username'];
    }
}

public function getNombre()
{
    return $this->nombre;
}

}


?>
