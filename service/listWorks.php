<?php

include("../repository/tarea.php");

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "GET") {
    $work = new tarea();

    $resp = $work->listTareas();
    echo json_encode($resp);
}
?>