<?php

// [ ] generate url

$data = file_get_contents("php://input");

header("Content-type: application/json");
echo json_encode($data);
