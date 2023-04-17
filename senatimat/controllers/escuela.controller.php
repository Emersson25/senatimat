<?php

require_once '../models/Escuela.php';

if (isset($_POST['operacion'])){

  $escuela = new Escuela();

  if ($_POST['operacion'] == 'listar'){

    $data = $escuela->listarEscuelas();

    if ($data){
      echo "<option value='' selected>Seleccione</option>";
      foreach($data as $registro){
        echo "<option value='{$registro['idescuela']}'>{$registro['escuela']}</option>";
      }
    }else{
      echo "<option value=''>No encontramos registros</option>";
    }

  }

}