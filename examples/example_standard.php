<?php

$start_time = microtime(true);
$isDev = true;

require_once "../fastDbgPHP.class.php";

// FastDbgPHP Configuration
FastDbgPHP::setDevelopmentMode($isDev);

// Optionais configs
FastDbgPHP::setStartTime($start_time);
FastDbgPHP::setProjectName("Project Example");
FastDbgPHP::setDefaltValues(["##GET", "##POST", "##SERVER"]);

class Person
{
    public function __construct(
        public string $name,
        public string $age
    ) {}
}
FastDbgPHP::setClassList(["Person"]);
FastDbgPHP::setStyles([
    "header"    => "color: #404040;
                    font-size: 18px;
                    padding: 0 0 10px;"
]);

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
$i = new Person("Maria", 19);

fdbg($a, $b, $c, $d, $e, $f, $g, $h, $i);

fdbg();

