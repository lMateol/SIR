<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<?php 
require_once "../../Model/categoryModel1.php";

$producto = new categoriaModel1();
//CONEXION
$conec = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
// set the PDO error mode to exception
$conec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "Connected successfully"; 
  $buscar="SELECT * FROM tbl_categoria_producto where id_Categoria=?";
	$resultadoPro=$conec->prepare($buscar);
	$resultadoPro->execute(array($_GET["id"]));
	$resultadoProducto;
	$datos=$resultadoPro->fetch(PDO::FETCH_OBJ);
	if ($datos==null) {
		return false;
	}else {
		$producto = new categoriaModel1();
		$producto->__SET('id_Categoria',$datos->id_Categoria);
		$producto->__SET('categoria',$datos->categoria);
		$producto->__SET('estado',$datos->estado);
    $resultadoProducto=$producto;
    }
?>
<style type="text/css">
  .container{  
   width:700px;
   height: 415px;
 }
</style>

<br>        
<div class="container">
    <div class="col-md-16">
      <div class="panel panel-default">
          <div class="panel-heading clearfix">&nbsp&nbsp
             <span class="glyphicon glyphicon-edit fa-fax3 fa-lg"></span>
             <label ><h4><b>Editar Categoria</b></h4></label>
          </div>
      <div class="panel-body"> 
    <form action="#" id="validate_form" method="post" class="ml-2">

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label>Nombre Categoria*</label><br>
          <input type="text" name="categoria" class="form-control" placeholder="Ingrese Nombre del producto"  required 
					value="<?php echo $resultadoProducto->__GET('categoria')?>"><br>
        </div>
        <div class="col-md-6 mb-3">
        <label>Estado*</label><br>
          <select name="estado" class="custom-select form-control" required="">
						<option value="true"disabled>Seleccione estado</option>
						<?php
            if ($resultadoProducto->__GET('estado')==1) {
            echo '<option value="1" selected>Activo</option>
								<option value="0">Inactivo</option>';
							}else {
								echo '<option value="1">Activo</option>
								<option value="0"selected>Inactivo</option>';
							}
						?>						
					</select><br>
        </div>
      </div>
      <div class="col-md-12">
      <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Enviar" >
      <input type="reset" value="Limpiar" class="btn btn-secondary">
     <a href="list_product.php"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
     </div>
    </form>
  </div>
</div>
</div>
</div>

    
<script>  
$(document).ready(function(){  
    $('#validate_form').parsley();
});  
</script>

<?php 

if (isset($_POST['submit'])) {
  $producto->__SET('id_Categoria',$_GET['id']);
  $producto->__SET('categoria',$_POST['categoria']);
  $producto->__SET('estado',$_POST['estado']);

  $actualizar="UPDATE `tbl_categoria_producto` SET `categoria`=?,`estado`=? WHERE `id_Categoria`=?";
  try {
    $conec->prepare($actualizar)->execute(array(
      $producto->__GET('categoria'),
      $producto->__GET('estado'),
      $producto->__GET('id_Categoria'),
      ));
      echo'<script>confirm("CATEGORIA ACTUALIZADA")</script>';
    }catch (Exception $e){
      echo "Error al buscar datos ".$e->getMessage();
      echo'<script>confirm("ERRROR ACTUALIZAR")</script>';
    }
} ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../public/js/jquery.js"></script>
  <script src="../../public/js/sweetalert.min.js"></script>                
  <script src="../../public/js/sweetalert-dev.js"></script>   
</div>