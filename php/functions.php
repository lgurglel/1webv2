<?php

// Validate functions
function validateX($xVal) {
    return isset($xVal);
}

function validateY($yVal) {
    $Y_MIN = -3;
    $Y_MAX = 3;

    if (!isset($yVal))
        return false;

    $numY = str_replace(',', '.', $yVal);
    return is_numeric($numY) && $numY >= $Y_MIN && $numY <= $Y_MAX;
}

function validateR($rVal) {
    $R_MIN = 1;
    $R_MAX = 4;

    if (!isset($rVal))
        return false;

    $numR = str_replace(',', '.', $rVal);
    return is_numeric($numR) && $numR >= $R_MIN && $numR <= $R_MAX;
}

function validateForm($xVal, $yVal, $rVal) {
    return validateX($xVal) && validateY($yVal) && validateR($rVal);
}

// Hit check functions
function checkTriangle($xVal, $yVal, $rVal) {
    return $xVal <= 0 && $yVal >= 0 &&
        $xVal <= $rVal/2 && $yVal <= $rVal;
}

function checkRectangle($xVal, $yVal, $rVal) {
    return $xVal >= 0 && $yVal <= 0 &&
        $xVal <= $rVal && $yVal <= $rVal;
}

function checkCircle($xVal, $yVal, $rVal) {
    return $xVal <= 0 && $yVal <= 0 &&
        sqrt($xVal*$xVal + $yVal*$yVal) <= $rVal;
}
function checkHit($xVal, $yVal, $rVal) {
    return checkTriangle($xVal, $yVal, $rVal) || checkRectangle($xVal, $yVal, $rVal) ||
        checkCircle($xVal, $yVal, $rVal);
}

$xVal = $_POST['X'];
$yVal = $_POST['Y'];
$rVal = $_POST['R'];

$timezone = $_POST['timezone'];

$INSIDE = checkHit($xVal,$yVal,$rVal);
$CONVERTED_INSIDE = $INSIDE ? "Внутри": "Снаружи";
$current_time = date("j M o G:i:s", time()-$timezone*60);
$executionTime = round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 7);

$ANSWER = "<tr>";
$ANSWER .= "<td>" . $xVal . "</td>";
$ANSWER .= "<td>" . $yVal . "</td>";
$ANSWER .= "<td>" . $rVal . "</td>";
$ANSWER .= "<td>" . $current_time . "</td>";
$ANSWER .= "<td>" . $executionTime . "</td>";
$ANSWER .= "<td>" . $CONVERTED_INSIDE . "</td>";
$ANSWER .= "</tr>";

echo $ANSWER;
