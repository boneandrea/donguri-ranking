<?php
require "vendor/autoload.php";

$results = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__."/results.yaml"), true);
$members=json_decode(file_get_contents(__DIR__."/users.json"), true);

$whatis=[
    "ゴロを打つ",
    "とにかく乗らない、60yに未だ誰も乗らない、どうしようもない",
    "なぜか入らない",
];
