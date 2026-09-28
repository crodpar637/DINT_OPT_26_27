<?php
$x = 313;
$y = 979;
$z = 123;

echo "Variable x: {$x} <br>";
echo "Variable y: {$y} <br>";
echo "Variable z: {$z} <br>";

$suma = $x + $y + $z;
echo "La suma es: {$suma} <br>";

$resta = $x - $y - $z;
echo "La resta es: {$resta} <br>";

$multiplicacion = $x * $y * $z;
echo "La multiplicacion es: {$multiplicacion} <br>";

$division = $x / $y;
echo "La division es: {$division} <br>";

$division_number_format = number_format($division,2);
echo "La division con number_format es: {$division_number_format}  <br>";

$division_casting = (int) ($x / $y);
echo "La division con casting es: {$division_casting} <br>";

$division_round = round($division,2, PHP_ROUND_HALF_DOWN);
echo "La division con round es: {$division_round}  <br>";