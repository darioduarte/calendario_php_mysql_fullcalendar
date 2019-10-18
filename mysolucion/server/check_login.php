<?php
require('../server/conector.php');
require('../server/access.php');


$conector = new ConectorBD($host, $user, $password);
$conexion = $conector->initConexion('final_agenda');

$username_post = $_POST['username'];
$object = array();
$password_comparison;

if ($conexion === 'OK') {
  if ($resultado = $conector->consultar(['user'], ['username','password'],"WHERE username = "."'".$username_post."'")) {
    while ($fila = $resultado->fetch_assoc()) {
      array_push($object, $fila);
    }
    $hash = str_replace(".","",$object[0]['password']);
    $password_comparison = password_verify($_POST['password'], $hash);

    if ($object[0]['username'] === $_POST['username']) {
        //echo $object[0]['password']." ".$_POST['username'];
        if ($password_comparison) {
          $object[0]['msg'] = 'OK';
          $o = json_encode($object[0]);
          session_start();
          $_SESSION['user'] = $object[0]['username'];
          
          echo $o;
        }
    }
  }
}else {
  $conexion;
}

$conector->cerrarConexion();



 ?>
