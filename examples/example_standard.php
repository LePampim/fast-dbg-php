<?php

use LePampim\FastDbgPHP\FastDbgPHP;

require_once "../src/fastdbgphp.php";

$start_time = microtime(true);
$isDev = true;

// fastdbgphp Configuration
FastDbgPHP::setDevelopmentMode($isDev);

// Optionais configs
FastDbgPHP::setInicialTime($start_time);
FastDbgPHP::setProjectName("Project Example");
FastDbgPHP::setDefaultValues(["##GET", "##POST", "##SERVER"]);
FastDbgPHP::setIsExit(true);
// FastDbgPHP::setclickToCopy(false);
FastDbgPHP::setStyles([
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

