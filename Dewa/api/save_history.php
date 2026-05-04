<?php
$api_key = "EDAA_2026";
$file = "../data/history.json";

if ($_POST['key'] != $api_key) exit("unauthorized");

$data = [
    "tinggi" => $_POST['tinggi'],
    "status" => $_POST['status'],
    "hujan"  => $_POST['hujan'],
    "waktu"  => date("Y-m-d H:i:s")
];
if(!isset($_POST['tinggi'])) exit("invalid");
$history = [];
if(file_exists($file)){
    $history = json_decode(file_get_contents($file), true);
}

$history[] = $data;
file_put_contents($file, json_encode($history, JSON_PRETTY_PRINT));

include "telegram.php";
?>
