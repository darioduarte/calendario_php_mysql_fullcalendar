<?php
require('../server/conector.php');
require('../server/access.php');
$micontraseñaencriptada = password_hash('111' , PASSWORD_DEFAULT);
$User['username'] = "'lupefinanciera@gmail.com'";
$User['password'] = "'.$micontraseñaencriptada.'";


$conector = new ConectorBD($host, $user, $password);
$conexion = $conector->initConexion('final_agenda');

if ($conexion === 'OK') {
  echo print_r($User);
  if ($conector->insertData('user', $User)) {
    echo "correcto";
  }else {
    echo "error";
  }

}else {
  echo print_r($conexion);
}
$conector->cerrarConexion();





 ?>
