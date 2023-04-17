<?php

require_once '../models/Carrera.php';

if (isset($_POST['operacion'])){

  $carrera = new Carrera();

  if ($_POST['operacion'] == 'listar'){

    $data = $carrera->listarCarreras($_POST['idescuela']);

    if ($data){
      echo "<option value='' selected>Seleccione</option>";
      foreach($data as $registro){
        echo "<option value='{$registro['idcarrera']}'>{$registro['carrera']}</option>";
      }
    }else{
      echo "<option value=''>No encontramos registros</option>";
    }

  }

}