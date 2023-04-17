<?php

require_once 'Conexion.php';

class Escuela extends Conexion{

  private $accesoBD;

  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion();
  }

  public function listarEscuelas(){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_escuelas_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

}