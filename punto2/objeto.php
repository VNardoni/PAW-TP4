<?php
class objeto{
    
     private $host;
  private $puerto;
  private $nombreBD;
  private $usuario;
  private $contraseña;
    
    
    
     function constructor($host, $puerto, $nombreBD, $usuario, $contraseña)
  {
  
    $this->host = $host;
    $this->puerto = $puerto;
    $this->nombreBD =$nombreBD;
    $this->usuario = $usuario;
    $this->contraseña = $contraseña;
  }
    
 
}