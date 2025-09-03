<?php

include_once 'functions.php';

$greeting = greeting('TIMO', 'paul');
echo $greeting;

for ($i = 0; $i < 10; $i++) {
    $greeting .= '!';
}

$array = [10, 20, 30, 40, 50];
$k = count($array);
for ($i = 0; $i < $k; $i++) {
    $greeting .= $array[$i];
}

$hour = 13;
while ($hour > 10) {
    $greeting .= '??';
    $hour--;
}

do {
    $hour--;
} while ($hour > 10);

$array = [10, 20, 30, 40, 50];
foreach ($array as $key => $value) {

}

$v = 20;
switch ($v) {
    case 10:
        $greeting .= 'Zehn';
        break;
    case 20:
        $greeting .= 'Zwanzig';
        break;
    default:
        $greeting .= 'Etwas anderes';
        break;
}

$bool = true;
$string = $bool ? 'Wahr' : 'Falsch';

$lebensmittel = 'apfel';
$value = match ($lebensmittel) {
    'apfel' => 'Das Lebensmittel ist ein Apfel',
    'schokolade' => 'Das Lebensmittel ist Schokolade',
    'kuchen' => 'Das Lebensmittel ist ein Kuchen',
    default => 'Unbekanntes Lebensmittel',
};


$array = [10, 20, 30, 40, 50];
$array = [
    4 => 10,
    20 => 20,
    9 => 30,
    123 => 40,
    178 => 50,
];
$array[4];


