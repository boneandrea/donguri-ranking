<?php
require "vendor/autoload.php";
require_once("data/data.php");
require_once("data/commentHandler.php");
require_once("util.php");

$background=[
    // "portfolio-1.jpg",
    // "portfolio-2.jpg",
    // "portfolio-3.jpg",
    "portfolio-4.jpg",
    // "portfolio-5.jpg",
    // "portfolio-6.jpg",
    // "portfolio-7.jpg",
];

// 1st, 2nd などを表示
$ordinalNumber = new \Twig\TwigFunction('ordinalNumber', function ($num) {
    $n = $num % 10;
    $t = floor($num / 10) % 10;

    if($t === 1){
        return $num . "th";
    } else {
        switch($n) {
            case 1:
                return $num . "st";
            case 2:
                return $num . "nd";
            case 3:
                return $num . "rd";
            default:
                return $num . "th";
        }
    }
});

// average
$ranking=calculate_ranking_by_average($results, 2023);
//dump_ranking($ranking); exit;
//var_dump($results); exit;

// コメント登録
$ch=new CommentHandler();
$ch->registerComment(date: $argv[1], userId: $argv[2], comment:$argv[3]);

// 試合結果とコメントをマージ
$results=$ch->mergeComment($results,$members);

// render
$loader = new \Twig\Loader\FilesystemLoader('./templates');
$twig = new \Twig\Environment($loader);
$twig->addFunction($ordinalNumber);
echo $twig->render('index.html', compact("whatis", "background","results","members","ranking"));
