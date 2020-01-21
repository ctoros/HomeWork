<?php

include("../repository/user.php");

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST") {
    $user = new User();
    $user->setEmail($_POST["email"]);

    $resp = $user->getUserByEmail();
    if ($resp[0]) {
        http_response_code(200);
    } else {
        http_response_code(400);
    }
    echo $resp[1];
}
?>