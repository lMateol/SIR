<?php

class UsuarioModel 
{

    private $cedula;
    private $nombre;
    private $email;
    private $usuario;
    private $password;
    

    public function __GET($atr)
    {
        return $this->$atr;
    }

    public function __SET($atr, $vl)
    {
       $this->$atr=$vl;
    }

}

?>