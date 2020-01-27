<?php

include("../repository/tarea.php");

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST") {
    $work = new Tarea();
    $work->setId($_POST["titulo"]);

    $resp = $work->deleteByTitle();
    if ($resp[0]) {
        http_response_code(200);
    } else {
        http_response_code(400);
    }
    echo json_encode($resp[1]);
}
?>