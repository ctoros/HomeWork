<?php

include("../repository/tarea.php");

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST") {
    $work = new tarea();
    $work->setTitulo($_POST["titulo"]);
    $work->setDescripcion($_POST["descripcion"]);

    $resp = $work->save();
    if ($resp[0]) {
        http_response_code(200);
    } else {
        http_response_code(400);
    }
    echo $resp[0];
}
?>