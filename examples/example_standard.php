<?php

use LePampim\fastdbgphp\fastdbgphp;

use function LePampim\fastdbgphp\fdbg;

$start_time = microtime(true);
$isDev = true;

require_once "../src/fastdbgphp.php";

// fastdbgphp Configuration
fastdbgphp::setDevelopmentMode($isDev);

// Optionais configs
fastdbgphp::setInicialTime($start_time);
fastdbgphp::setProjectName("Project Example");
fastdbgphp::setDefaultValues(["##GET", "##POST", "##SERVER"]);
fastdbgphp::setIsExit(true);
// fastdbgphp::setclickToCopy(false);
fastdbgphp::setStyles([
    "header"    => "color: #404040;
    font-size: 18px;
    padding: 0 0 10px;"
]);

class Person
{
    public function __construct(
        public string $name,
        public string $age
    ) {}
}

$a = "Hello Word";
$b = null;
$c = True;
$d = 42;
$e = 3.14159265359;
$f = [];
$g = ["orange", "banana", "apple"];
$h = [
    "name" => [
        "first" => "Gustavo",
        "midle" => ["de", "Sousa"],
        "last" => "Correa"
    ],
    "age" => 18,
    "from" => "Brazil"
];
$i = new Person("Maria", 7);
$j = new DateTime();
$k = " Espaços em branco antes e depois  ";

fdbg($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k);
fdbg('##GETENV'); 
fdbg();

