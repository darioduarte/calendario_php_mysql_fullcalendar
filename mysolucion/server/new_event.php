<?php

require('../server/conector.php');
require('../server/access.php');
session_start();
$conector = new ConectorBD($host, $user, $password);
$conexion = $conector->initConexion('final_agenda');
$object = json_encode($_POST);
$username_post = $_SESSION['user'];
$object = array();


if ($conexion === 'OK') {
  $resultado = $conector->consultar(['user'], ['iduser'],"WHERE username = "."'".$username_post."'");
  while ($fila = $resultado->fetch_assoc()) {
    array_push($object, $fila);
  }
  $_POST['fk_user'] = $object[0]['iduser'];
  if ($conector->insertData('evento', $_POST)) {
    $response['msg'] = 'OK';
    $json = json_encode($response);
    echo $json;
  }


}else {
  echo "NO SE PUDO INGRESAR EL EVENTO";
}
$conector->cerrarConexion();

 ?>
