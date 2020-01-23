<?php

include("../repository/user.php");

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST") {
    $user = new usuario();
    $user->setEmail($_POST["email"]);
    $user->setNombre($_POST["nombre"]);
    $user->setPassword($_POST["password"]);

    $resp = $user->updateByID();
    if ($resp[0]) {
        http_response_code(200);
    } else {
        http_response_code(400);
    }
    echo $resp[0];
}
?>