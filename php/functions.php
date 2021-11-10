<?php
error_reporting(0);

session_start();
date_default_timezone_set('Europe/Moscow');

if (!isset($_SESSION["answer"])) $_SESSION["answer"] = array();

function validateX($x) {
    return isset($x);
}

function validateY($y) {
    $Y_MIN = -3;
    $Y_MAX = 3;

    if (!isset($y))
        return false;

    $numY = str_replace(',', '.', $y);
    return is_numeric($numY) && $numY > $Y_MIN && $numY < $Y_MAX;
}

function validateR($r) {
    $R_MIN = 1;
    $R_MAX = 4;

    if (!isset($r))
        return false;

    $numR = str_replace(',', '.', $r);
    return is_numeric($numR) && $numR > $R_MIN && $numR < $R_MAX;
}



function isDataValid($x, $y, $r)
{
    return (validateR($r) && validateX($x) && validateY($y));
}

function checkTriangle($x, $y, $r) {
    return $x <= 0 && $y >= 0 &&
        $x*2 <= $r && $y <= $r;
}

function checkRectangle($x, $y, $r) {
    return $x >= 0 && $y <= 0 &&
        $x <= $r && $y <= $r;
}

function checkCircle($x, $y, $r) {
    return $x <= 0 && $y <= 0 &&
        sqrt($x*$x + $y*$y) <= $r;
}


function checkHit($x, $y, $r) {
    return checkTriangle($x, $y, $r) || checkRectangle($x, $y, $r) ||
        checkCircle($x, $y, $r);
}

$x =  $_POST["X"];
$y =  $_POST["Y"];
$r =  $_POST["R"];

if (!isDataValid($x, $y, $r)) {
    http_response_code(400);
    return;
} else {
    $coordsStatus = checkHit($x, $y, $r) ? "Внутри": "Снаружи";
    $currentTime = date("H : i : s");
    $benchmarkTime = number_format(microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"], 10, ".", "") * 1000000;
    array_push($_SESSION["answer"], "<tr>
    <td>$x</td>
    <td>$y</td>
    <td>$r</td>
    <td>$currentTime</td>
    <td>$benchmarkTime</td>
    <td>$coordsStatus</td>
    </tr>");
    foreach ($_SESSION["answer"] as $tableRow) echo $tableRow;
}

