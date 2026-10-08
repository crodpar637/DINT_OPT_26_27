<?php
declare(strict_types=1);

function suma(int $a, float $b): int{
	return (int) ($a + $b);
}

$s = 4;
$sum = suma($s, 7.8);
echo "<p>El resultado es {$sum}</p>";
?>