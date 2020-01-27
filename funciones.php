<?php
session_start();

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
          // Set session variables
          $_SESSION["id"] = $row[0];
          $_SESSION["nombre"] = $row[3];
          $_SESSION["email"] = $row[1];
     
                  header('Location: profile.php');
            }
    }

      echo "Contraseña o Email Incorrecto";
      echo "<br><a href='login.php'>Volver a Intentarlo</a>";

 
    mysqli_close($con); 
 ?>


