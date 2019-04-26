<?php
    require_once "./Model/vistasModel.php";
    class vistasController extends vistasModel{ 
        
        public function obtener_plantilla_controlador(){
            //con este metodo mostramos por defecto la plantilla
            return require_once "./View/plantilla.php";
        }

        public function obtener_vistas_controlador(){
            //validamos que la url contenga información
            if (isset($_GET['views'])) {
                //separamos lo que trae la variable de acuerdo a "/"
                $ruta = explode('/',$_GET['views']);
                //obtenemos la vista que trae la variable "view"
                //tomamos ruta[0] ya que al separarlo nos da un vector
                $respuesta = vistasModel::obtener_vistas_modelo($ruta[0]);
            }else {
                //si 'views' no trae información llamamos el login
                $respuesta = "login";
            }
            return $respuesta;
        }
    }
