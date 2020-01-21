<?php

include 'conexion.php';

$conexion = new mysqli($host, $user, $pass, $base);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuario WHERE email = '$email'";
$result = mysqli_query($conexion, $sql);

      if(mysqli_fetch_row($result) == 0){

         echo "Email incorrecto.";


          echo "<br><a href='login.html'>Volver a Intentarlo</a>"; 

          $result -> free_result();
          $mysqli -> close(); 

      }else{

            $row = mysqli_fetch_assoc($result);

            $sql2 = "SELECT * FROM usuario WHERE email = '$email' AND password = '$password'";
            $result2 = mysqli_query($conexion, $sql2);

            if(mysqli_fetch_row($result2) == 0){

                $_SESSION['loggedin'] = true;
                $_SESSION['nombre'] = $row['nombre'];
                // $_SESSION['start'] = time();
                // $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

                echo "Bienvenido! " . $_SESSION['nombre'];
                echo "<br><br><a href=index2.html>Index</a>"; 
                // header('Location: http://localhost/HomeWork/index2.html');//redirecciona a la pagina del usuario
                                    $result -> free_result();
                        $mysqli -> close(); 

            }else{
              
               echo "Password incorrecto.";

              echo "<br><a href='login.html'>Volver a Intentarlo</a>"; 

                        $result -> free_result();
                        $mysqli -> close(); 
            }

 

           
      }



      




// $hash = $row['password'];



// if ($password==$row['password']) { 

 
//     $_SESSION['loggedin'] = true;
//     $_SESSION['email'] = $email;
//     // $_SESSION['start'] = time();
//     // $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

//     echo "Bienvenido! " . $_SESSION['mail'];
//     echo "<br><br><a href=panel-control.php>Panel de Control</a>"; 
//     header('Location: http://localhost/HomeWork/index2.html');//redirecciona a la pagina del usuario

//  } else { 
//    echo "Username o Password estan incorrectos.";

//    echo "<br><a href='login.html'>Volver a Intentarlo</a>";
//  }
 mysqli_close($conexion); 
 ?>