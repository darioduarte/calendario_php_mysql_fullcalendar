<?php
require('../server/conector.php');
require('../server/access.php');
session_start();
$conector =  new ConectorBD($host, $user, $password);
$conexion = $conector->initConexion('final_agenda');
$username_post = $_SESSION['user'];
$id = $_POST['id'];
if ($conexion === "OK") {
  $conector->eliminarRegistro('evento', "idagenda = '$id'");
  $response['msg'] = 'OK';
  $json = json_encode($response);
  echo $json;
}

 ?>
