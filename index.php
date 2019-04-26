<?php 
   require_once './core/configGeneral.php';
   require_once './Controller/vistasController.php';
   $plantilla = new vistasController();
   $plantilla->obtener_plantilla_controlador();
