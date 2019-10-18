<?php
require('../server/conector.php');
require('../server/access.php');
session_start();
$conector =  new ConectorBD($host, $user, $password);
$conexion = $conector->initConexion('final_agenda');
$username_post = $_SESSION['user'];

if ($conexion === 'OK') {
  if ($_POST['allDay'] === 'true') {
    $id = $_POST['id'];
    $update['start_date'] = "'".$_POST['start_date']."'";
    $conector->actualizarRegistro('evento', $update, "idagenda = '$id'");
  } else {
    $id = $_POST['id'];
    $update['start_date'] = "'".$_POST['start_date']."'";
    $update['end_date'] = "'".$_POST['end_date']."'";
    $update['start_hour'] = "'".$_POST['start_hour']."'";
    $update['end_hour'] = "'".$_POST['end_hour']."'";
    $conector->actualizarRegistro('evento', $update, "idagenda = '$id'");
  }
  $response['msg'] = 'OK';
  $json = json_encode($response);
  echo $json;
}

 ?>
