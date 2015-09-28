<?php

echo json_encode([
    "error" => true,
    "code" => \VTRMVC\Core\View::$bag["code"]
]);