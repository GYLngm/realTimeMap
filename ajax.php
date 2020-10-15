<?php
    require_once('./settings.php');

    $data = generateRandomDataBySecond(600);
    $json = json_encode($data);

    header('Content-Type: application/json, charset=utf-8');
    echo $json;
    die();