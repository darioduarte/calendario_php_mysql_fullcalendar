<?php
require('../server/conector.php');
require('../server/access.php');
session_start();
$conector =  new ConectorBD($host, $user, $password);
$conexion = $conector->initConexion('final_agenda');
$username_post = $_SESSION['user'];
$object = array();

if ($resultado = $conector->consultaCompuesta(['evento','user'], ['idagenda','titulo','start_date','start_hour','end_date','end_hour','allDay'], ['fk_user','iduser'] , "WHERE username = 'valorconstant@gmail.com'")) {
  while ($fila = $resultado->fetch_assoc()) {
    if ($fila['allDay'] === "1") {
      $response["id"] = $fila['idagenda'];
      $response["title"] = $fila['titulo'];
      $response["start"] = $fila['start_date'];
      $response["allDay"] = true;
      array_push($object, $response);
    }else{
      $response["id"] = $fila['idagenda'];
      $response["title"] = $fila['titulo'];
      $response["start"] = $fila['start_date']."T".$fila['start_hour'];
      $response["end"] = $fila['end_date']."T".$fila['end_hour'];
      $response["allDay"] = false;
      array_push($object, $response);
    }

  }

  $json = json_encode($object);
  echo $json;
}



?>
