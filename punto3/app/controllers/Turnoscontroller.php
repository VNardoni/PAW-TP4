<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Turnos;

class TurnosController extends Controller
{
    public function __construct()
    {
        $this->model = new Turnos();
    }

    /**
     * Show all task
     */
  
    public function nuevoTurno()
    {
        $today =  date("Y-m-d");
        return view('turnos.nuevo', compact('today'));
        return view('turnos.nuevo', compact('today'));
    }

    public function registrarTurno()
    {
        $errores = [];

        if( !(isset($_POST['nombre']) &&
          preg_match('/^[A-Za-z]/',$_POST['nombre'])) )
        {
          $errores[] = "error en el nombre";
        }

        if( !(isset($_POST['email']) &&
            preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',$_POST['email'])) )
        {
          $errores[] = "error en el email";
        }

        if( !(isset($_POST['telefono']) &&
            is_numeric($_POST['telefono'])) )
        {
          $errores[] = "error en el telefono";
        }

        if( !(isset($_POST['talla_calzado']) &&
            is_numeric($_POST['talla_calzado']) &&
            is_int((int)$_POST['talla_calzado'])&&
            $this->in_range($_POST['talla_calzado'],19,46)))
        {
          $errores[] = "error en el talle";
        }


        if( !(isset($_POST['fecha_de_nacimiento']) &&
            $this->validar_fecha($_POST["fecha_de_nacimiento"])))
        {
          $errores[] = "error en la fecha de nacimiento";
        }

        if(!( isset($_POST['fecha_del_turno']) &&
            $this->validar_fecha($_POST["fecha_del_turno"])))
        {
          $errores[] = "error en la fecha del turno";
        }

        if( !(isset($_POST['horario_del_turno']) &&
            $this->hourIsBetween('08:00','17:00', $_POST['horario_del_turno'])))
        {
          $errores[] = "error en el horario del turno";
        }
     
       

     
        if (!empty($_FILES['imagen_diagnostico']['tmp_name'])) {
            if( !($_FILES['imagen_diagnostico']['type'] === 'image/png' ||
                  $_FILES['imagen_diagnostico']['type'] === 'image/jpg' ||
                  $_FILES['imagen_diagnostico']['type'] === 'image/jpeg'))
          {
            $errores[] = "error en la imagen";
          }
        }

        if(empty($errores)){
            $turnos = $this->model->get();
            $contador = 1;
            if(!sizeof($turnos) == 0){
                $contador = end($turnos)->id + 1;
            }
            
            if(!empty($_FILES['imagen_diagnostico']['tmp_name'])){
                //me guardo el nombre y creo el archivo;
                $nombre_imagen = $contador.'_'.$_FILES['imagen_diagnostico']['name'];
                move_uploaded_file($_FILES['imagen_diagnostico']['tmp_name'], 'image\\'.$nombre_imagen);

            }

            $turno = array('nombre' => $_POST["nombre"],
                'email'=> $_POST["email"],
                'telefono' => $_POST["telefono"],
                'edad' => $_POST["edad"],
                'talla_calzado' => $_POST["talla_calzado"],
                'altura' => $_POST["altura"],
                'fecha_de_nacimiento' => $_POST["fecha_de_nacimiento"],
                'color_de_pelo' => $_POST["color_de_pelo"],
                'fecha_del_turno' => $_POST["fecha_del_turno"],
                'horario_del_turno' => $_POST["horario_del_turno"],
                'imagen_diagnostico' => $nombre_imagen);
            $this->model->insert($turno);
            return redirect('turnos');
        }else{
            echo("error");
        }
    }

    private function validar_fecha($fecha){
        $valores = explode('-', $fecha);
        if(count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])){
            return true;
        }
        return false;
    }

    private function hourIsBetween($from, $to, $input) {
        $dateFrom = \DateTime::createFromFormat('!H:i', $from);
        $dateTo = \DateTime::createFromFormat('!H:i', $to);
        $dateInput = \DateTime::createFromFormat('!H:i', $input);
        if ($dateFrom > $dateTo) $dateTo->modify('+1 day');
        return ($dateFrom <= $dateInput && $dateInput <= $dateTo) || ($dateFrom <= $dateInput->modify('+1 day') && $dateInput <= $dateTo);
    }

    private function in_range($value, $min, $max){
        return ($value>$min) && ($value<$max);
    }

  public function index()
    {
        $turnos = $this->model->get();
        return view('turnos', compact('turnos'));
    }

    public function resumen()
    {
        $turno;
        $pathImage;
        $turnos = $this->model->get();
        foreach ($turnos as $tno) {
            if($_GET['id'] == $tno->id){
                $turno = $tno;
                $pathImage = '\\image\\'.$tno->imagen_diagnostico;
                break;
            }
        }

        return view('turnos.resumen', compact('turno','pathImage'));
    }
}