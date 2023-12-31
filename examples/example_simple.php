<?php

$isDev = true;

require_once "../fastdDbgPHP.class.php";

// FastDbgPHP Configuration
FastDbgPHP::setDevelopmentMode($isDev);

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

dbg($a, $b, $c, $d, $e, $f, $g, $h);

dbg();
