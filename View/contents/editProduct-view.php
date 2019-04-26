<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<?php 
require_once "../../Model/personModel1.php";
require_once "../../Model/categoryModel1.php";
require_once "../../Model/productModel1.php";
$usuario = new  personModel1();
$producto = new productoModel1();
//CONEXION
$conec = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
// set the PDO error mode to exception
$conec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "Connected successfully"; 
  $buscar="SELECT * FROM tbl_producto where id_producto=?";
	$resultadoPro=$conec->prepare($buscar);
	$resultadoPro->execute(array($_GET["id"]));
	$resultadoProducto;
	$datos=$resultadoPro->fetch(PDO::FETCH_OBJ);
	if ($datos==null) {
		return false;
	}else {
		$producto = new productoModel1();
		$producto->__SET('id_producto',$datos->id_producto);
		$producto->__SET('nombre_producto',$datos->nombre_producto);
		$producto->__SET('referencia',$datos->referencia);
		$producto->__SET('precio_unitario',$datos->precio_unitario);
		$producto->__SET('IVA_Producto',$datos->IVA_Producto);
		$producto->__SET('Categoria_Producto_id_Categoria',$datos->Categoria_Producto_id_Categoria);
		$producto->__SET('Persona_id_persona',$datos->Persona_id_persona);
		$producto->__SET('cantidad',$datos->cantidad);
		$producto->__SET('estado',$datos->estado);
    $resultadoProducto=$producto;
    }
?>
<style type="text/css">
  .container{  
   width:900px;
   height: 415px;
 }
</style>

<br>        
<div class="container">
    <div class="col-md-16">
      <div class="panel panel-default">
          <div class="panel-heading clearfix">&nbsp&nbsp
             <span class="glyphicon glyphicon-edit fa-fax3 fa-lg"></span>
             <label ><h4><b>Editar Producto</b></h4></label>
          </div>
      <div class="panel-body"> 
    <form action="#" id="validate_form" method="post" class="ml-2">

      <div class="form-row">
        <div class="col-md-4 mb-3">
          <label>referencia*</label><br>
          <input type="text" name="referencia" class="form-control" placeholder="Ingrese referencia"  required 
					value="<?php echo $resultadoProducto->__GET('referencia')?>"><br>
        </div>
        <div class="col-md-4 mb-3">
          <label>Nombre Producto*</label><br>
          <input type="text" name="nombre_producto" class="form-control" placeholder="Ingrese Nombre del producto"  required 
					value="<?php echo $resultadoProducto->__GET('nombre_producto')?>"><br>
        </div>
        <div class="col-md-4 mb-3">
          <label>Precio Unitario*</label><br>
          <input type="number" name="precio_unitario" class="form-control" placeholder="Precio Unitario"  required 
					value="<?php echo $resultadoProducto->__GET('precio_unitario')?>"><br>
        </div>
        <div class="col-md-4 mb-3">
          <label>Iva Producto*</label><br>
          <input type="number" name="IVA_Producto" class="form-control" placeholder="IVA Producto"  required 
					value="<?php echo $resultadoProducto->__GET('IVA_Producto')?>"><br>
        </div>
        <div class="col-md-4 mb-3">
          <label>Categoria*</label><br>
          <select name="Categoria_Producto_id_Categoria" class="custom-select form-control" placeholder="Seleccione Estado"  required >
          <?php
          $datocategoria=array();
          $consulta="SELECT * FROM tbl_categoria_producto ORDER BY id_Categoria";
          $resultado=$conec->prepare($consulta);
          $resultado->execute();
          foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
            $categoria = new CategoriaModel1();
            $categoria->__SET('id_Categoria',$datos->id_Categoria);
            $categoria->__SET('categoria',$datos->categoria);
            $categoria->__SET('estado',$datos->estado);
            //asignamos cada categoria en una posicion del array
            $datocategoria[]=$categoria;
          }
          foreach ($datocategoria as $r) {
            //$r->estado==1 && VA EN EL IF PARA VALIDAR ESTADO DE LA CATEGORIA
            if ( $r->id_Categoria==$resultadoProducto->__GET('Categoria_Producto_id_Categoria')) {
              echo '<option value="'.$resultadoProducto->__GET('Categoria_Producto_id_Categoria').'"selected>'.$r->categoria.'</option>';
            }else {
              echo '<option value="'.$r->id_Categoria.'">'.$r->categoria.'</option>';
						}
          }
          var_dump($datocategoria);

          ?>
          </select><br>
        </div>
        <div class="col-md-4 mb-3">
          <label>Proveedor*</label><br>
          <select name="Persona_id_persona" class="custom-select form-control" placeholder="Seleccione Estado"  required ="">
            <option value="true" disabled>Seleccione Proveedor</option>
            <?php
              $datosPerson = array();
              
              // $consultar = "SELECT * FROM persona ORDER BY id_persona";
              $consultar = "SELECT per.estado as numEstado, per.id_persona, per.nombres, per.apellidos, doc.nombre_documento, per.documento, per.telefono, per.nro_Celular, per.direccion, per.ciudad, per.departamento, tper.nombre_tipo, CASE WHEN per.estado = 1 THEN 'Activo' ELSE 'Inactivo' END AS estado FROM tbl_persona per INNER JOIN tbl_tipo_documento doc ON per.tipo_documento_tipo_documento = doc.tipo_documento INNER JOIN tbl_tipo_persona tper ON per.tipo_persona_tipo_persona = tper.tipo_persona ORDER BY id_persona";
                $resultado = $conec->query($consultar);
                // $resultado = execute();
        
                foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $dato) {
                  $usuario = new personModel1();
                  $usuario->__SET('id_persona', $dato->id_persona);
                  $usuario->__SET('nombres', $dato->nombres);
                  $usuario->__SET('apellidos', $dato->apellidos);
                  $usuario->__SET('nombre_documento', $dato->nombre_documento);
                  $usuario->__SET('documento', $dato->documento);
                  $usuario->__SET('telefono', $dato->telefono);
                  $usuario->__SET('nro_Celular', $dato->nro_Celular);
                  $usuario->__SET('direccion', $dato->direccion);
                  $usuario->__SET('ciudad', $dato->ciudad);
                  $usuario->__SET('departamento', $dato->departamento);
                  $usuario->__SET('nombre_tipo', $dato->nombre_tipo);
                  $usuario->__SET('numEstado', $dato->numEstado);
                  $usuario->__SET('estado', $dato->estado);
        
                  $datosPerson[] = $usuario;
                }
                var_dump($datosPerson);
              foreach ($datosPerson as $dat) {
                  if ($dat->numEstado==1 and $dat->nombre_tipo=="Proveedor" && $dat->id_persona==$resultadoProducto->Persona_id_persona) {
									echo '<option value="'.$resultadoProducto->Categoria_Producto_id_Categoria.'"selected>'.$dat->nombres.'</option>';
                }else{
									echo '<option value="'.$dat->id_persona.'">'.$dat->nombres.'</option>';
								}
							}
            ?>
          </select><br>
        </div>
        <div class="col-md-4 mb-3">
          <label>Cantidad*</label><br>
          <input type="number" name="cantidad" class="form-control" placeholder="Cantidad"  required 
					value="<?php echo $resultadoProducto->__GET('cantidad'); ?>"><br>
        </div>
        <div class="col-md-4 mb-3">
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
  $producto->__SET('id_producto',$_GET['id']);
  $producto->__SET('referencia',$_POST['referencia']);
	$producto->__SET('nombre_producto',$_POST['nombre_producto']);
	$producto->__SET('precio_unitario',$_POST['precio_unitario']);
	$producto->__SET('IVA_Producto',$_POST['IVA_Producto']);
  $producto->__SET('Categoria_Producto_id_Categoria',$_POST['Categoria_Producto_id_Categoria']);
	$producto->__SET('Persona_id_persona',$_POST['Persona_id_persona']);
	$producto->__SET('cantidad',$_POST['cantidad']);
  $producto->__SET('estado',$_POST['estado']);

  $actualizar="UPDATE `tbl_producto` SET `referencia`=? ,`nombre_producto`=?,`precio_unitario`=?,`IVA_Producto`=?,
  `Categoria_Producto_id_Categoria`=?,`Persona_id_persona`=?,`cantidad`=?,`estado`=? WHERE `id_producto`=?";
  try {
    $conec->prepare($actualizar)->execute(array(
      $producto->__GET('referencia'),
      $producto->__GET('nombre_producto'),
      $producto->__GET('precio_unitario'),
      $producto->__GET('IVA_Producto'),
      $producto->__GET('Categoria_Producto_id_Categoria'),
      $producto->__GET('Persona_id_persona'),
      $producto->__GET('cantidad'),
      $producto->__GET('estado'),
      $producto->__GET('id_producto'),
      ));
      echo'<script>confirm("PERSONA ACTUALIZADA")</script>';
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