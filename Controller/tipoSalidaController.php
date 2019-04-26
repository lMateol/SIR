<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  
  try {
      $conn = new PDO("mysql:host=$servername;dbname=s.i.r", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo "Connected successfully"; 
      }
  catch(PDOException $e)
      {
      echo "Connection failed: " . $e->getMessage();
      }
    
    if (isset($_REQUEST['nombre']) && isset($_REQUEST['estado']) && (!isset($_REQUEST['editando']) || $_REQUEST['editando']==false)) {
        $nombre = $_REQUEST['nombre'];
        $estado = $_REQUEST['estado'];

        $insertar="INSERT INTO tbl_tipo_salida (nombre, estado) VALUES (?,?)";
		try {
			//conectamos y ejecutamos la consulta con sus respectivos parametros
			$conn->prepare($insertar)->execute(array(
				$nombre,
				$estado,
				));

			echo 1;
        } catch (\PDOException $e) {
           echo $e->getMessage();
        }
    }elseif (isset($_REQUEST['id']) && isset($_REQUEST['estado']) && !isset($_REQUEST['editando'])) {
        $id_categoria = $_REQUEST['id'];
        $est = $_REQUEST['estado'];
        $estado = ($est==1) ? 0 : 1 ;
        $cambiarE="UPDATE tbl_tipo_salida SET estado=? where tipo_salida=? ";
		try {
			//ejecutamos con la conexion y almacenamos lo que trae en la variable "resultado"
			$conn->prepare($cambiarE)->execute(array(
				$estado,
				$id_categoria
				));
			echo 1;

		} catch (Exception $e) {
			echo "error al actualizar estado ".$e->getMessage();
		}
    }elseif (isset($_REQUEST['consul'])) {
        $idC = $_REQUEST['consul'];
        $json0 = array();
        $buscar="SELECT * FROM tbl_tipo_salida where tipo_salida=?";
		try {
			$resultado=$conn->prepare($buscar);
            $resultado->execute(array($idC));
            
			$datos=$resultado->fetch(PDO::FETCH_OBJ);
            $json0[] = array(
                'tipo_salida' => $datos->tipo_salida,
                'nombre' => $datos->nombre,
                'estado' => $datos->estado,
            );

            $jsonstring0 = json_encode($json0);
            echo $jsonstring0;
		} catch (Exception $e) {
			echo "error al buscar ".$e->getMessage();
		}
    }elseif (isset($_REQUEST['nombre']) && isset($_REQUEST['estado']) && $_REQUEST['editando']==true) {
        $nombre = $_REQUEST['nombre'];
        $id_categoria = $_REQUEST['id'];
        $estado = $_REQUEST['estado'];
        $actualizar="UPDATE tbl_tipo_salida SET nombre=?, estado=? where tipo_salida=? ";
		try {
			//ejecutamos con la conexion y almacenamos lo que trae en la variable "resultado"
			$conn->prepare($actualizar)->execute(array(
				$nombre,
				$estado,
				$id_categoria
				));
                echo 1;

		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
    }else if (!isset($_REQUEST['nombre']) && !isset($_REQUEST['estado']) && !isset($_REQUEST['editando'])) {
        $json=array();
        $consulta="SELECT * FROM tbl_tipo_salida ORDER BY tipo_salida";
        try {
            $resultado=$conn->query($consulta);
            $resultado->execute();
            
            foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
                $json[] = array(
                    'tipo_salida' => $datos->tipo_salida,
                    'nombre' => $datos->nombre,
                    'estado' => $datos->estado,
                );
            }
            $jsonstring = json_encode($json, JSON_FORCE_OBJECT);
            var_dump($json);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
?>