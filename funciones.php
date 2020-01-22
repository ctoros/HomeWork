<?php

include 'conexion.php';

$con = mysqli_connect($host, $user, $pass, $base);

if (mysqli_connect_errno()) {
      echo "Fallo en la conexion:" . mysqli_connect_error();
      exit();
    }

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuario WHERE email = '$email' AND password = PASSWORD('$password')";

if ($result = mysqli_query($con, $sql)) {
   
      while ($row = mysqli_fetch_row($result)) {

                  header('Location: index2.html');
            }
    }

      echo "Contraseña o Email Incorrecto";
      echo "<br><a href='login.html'>Volver a Intentarlo</a>";

 
    mysqli_close($con); 
 ?>


