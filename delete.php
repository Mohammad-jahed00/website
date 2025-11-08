<?php
header('Content-Type: application/json; charset=utf-8');

if (!isset($_POST['file'])) {
    echo json_encode(["status" => "error", "message" => "no file"]);
    exit;
}


$file = basename($_POST['file']); 
$path = __DIR__ . '/uploads/' . $file;


if (file_exists($path)) {
    unlink($path);
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "file not found"]);
}