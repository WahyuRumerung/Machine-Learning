<?php
$token = "8687067205:AAFkcLlmMTmx0pkj0ng7S9uVq2H_2yrusg0";
$chat_id = "6896539677";

$tinggi = $_POST['tinggi'];
$status = $_POST['status'];
$hujan  = $_POST['hujan'];

$pesan = "⚠️ BANJIR\n\n";
$pesan .= "Status: $status\n";
$pesan .= "Air: $tinggi cm\n";
$pesan .= "Hujan: $hujan\n";

$url = "https://api.telegram.org/bot$token/sendMessage";

$data = [
    'chat_id' => $chat_id,
    'text' => $pesan
];
session_start();

if (!isset($_SESSION['last_status'])) {
    $_SESSION['last_status'] = "";
}

if ($_SESSION['last_status'] === $status) {
    exit("skip");
}

$_SESSION['last_status'] = $status;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_exec($ch);
curl_close($ch);
?>
