<?php
    class vistasModel{
        protected function obtener_vistas_modelo($vistas){
            //aquí estan todas aquellas palabra que permitiremos en URL
            $listaBlanca=["E403","404","403","resetPassword","Inicio","recoverPassword","changePassword","upload","profile","editAccount","logout","homeAdmin","recoverPassword","Categoria","tipoDocumento","tipoSalida","addPedido","addCategory","addEntry","addExit","addPerson","addProduct","addCategory",
            "deleteCategory","deleteEntry","deleteExit","deletePerson","deleteProduct","deleteComment",
            "listPedido","listCategory","listEntry","listExit","listPerson","listProduct","listComment","editCategory","editEntry","editExit","editPerson","editProduct"];
            //buscamos que la vista solicitada esté en la lista blanca
            if (in_array($vistas,$listaBlanca)) {
                //si el archivo esta en la listaBlanca y existe ejecutamos estó, si no el login
                if (is_file("./view/contents/".$vistas."-view.php")) {
                    $contenido = "./view/contents/".$vistas."-view.php";
                } else {
                    $contenido = "login";
                }
            // todos estos condicionales retirnan al login, si no trae nada, si trae login, etc.
            }elseif ($vistas=="login") {
                $contenido = "login";
            }elseif ($vistas == "index") {
                $contenido = "login";
            }else {
                $contenido = "login";
            }
            return $contenido;
         }
    }
