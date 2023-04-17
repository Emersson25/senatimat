<?php

require_once 'Conexion.php';

class Sede extends Conexion{

  private $accesoBD;

  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion();
  }

  public function listarSedes(){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_sedes_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

}