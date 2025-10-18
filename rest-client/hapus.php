<?php
include "config.php";

$nim = $_GET['nim'] ?? '';

if ($nim) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "$api_url?nim=$nim");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_exec($curl);
    curl_close($curl);
}

header("Location: index.php");
?>