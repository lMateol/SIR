<?php

echo'<script type="text/javascript"> 
swal({title: "LISTO",    
      text: "Sessión Cerrada Con Exito.", 
      type:"success", 
      confirmButtonText: "OK", 
      closeOnConfirm: false 
    }, 
    function(){ 
      window.location.href="'.SERVERURL.'login"; 
    });  
</script>'; 
session_unset(); 
session_destroy();
   ?>
  
