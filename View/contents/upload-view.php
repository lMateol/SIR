<?php
$host="root";
$contraseña="";
$conexionbd = new PDO('mysql:host=localhost;dbname=s.i.r', $host, $contraseña);

$nombrefoto = $_FILES['img']['name'];
$rutaaguardar = $_FILES['img']['tmp_name'];
$destinourl = "public/img/".$nombrefoto;
copy($rutaaguardar,$destinourl);

$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "UPDATE tbl_usuario set imagen='$nombrefoto', url='$destinourl' WHERE id_usuario=1";
$conexionbd->exec($sql);
echo'<script type="text/javascript"> 
swal({title: "LISTO",    
      text: "Imagen actualizada correctamente!.", 
      type:"success", 
      confirmButtonText: "OK", 
      closeOnConfirm: false 
    }, 
    function(){ 
      window.location.href="'.SERVERURL.'editAccount"; 
    });  
</script>'; 
?>