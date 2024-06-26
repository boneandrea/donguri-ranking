<?php

declare(strict_types=1);

namespace Donguri;

require_once __DIR__."/../../../vendor/autoload.php";

require_once(__DIR__."/../../../data/data.php");
require_once(__DIR__."/util.php");

class Donguri
{
    public $background = [
        // "portfolio-1.jpg",
        // "portfolio-2.jpg",
        // "portfolio-3.jpg",
        "portfolio-4.jpg",
        // "portfolio-5.jpg",
        // "portfolio-6.jpg",
        // "portfolio-7.jpg",
    ];

    // calculate besgro
    public function find_best_gross($games, $year)
    {
        $games_every_year = array_filter($games, fn ($e) =>
                                         preg_match("/^$year/", $e["date"]));
        $best_gross = 100000;
        foreach($games_every_year as $i) {
            foreach($i["score"] as $s) {
                if($s["gross"] < $best_gross) {
                    $best_gross = $s["gross"];
                }
            }
        }
        return $best_gross;
    }

    public function execute(array $argv = [])
    {
        global $results,$members,$whatis;
        // 1st, 2nd などを表示
        $ordinalNumber = new \Twig\TwigFunction('ordinalNumber', function ($num) {
            $n = $num % 10;
            $t = floor($num / 10) % 10;

            if($t === 1) {
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

        $years = range(2023, (int)date('Y'));

        // calculate average
        $ranking = [];
        foreach($years as $y) {
            $rank = calculate_ranking_by_average($results, $y);
            $rank["best_gross"] = $this->find_best_gross($results, $y);
            $ranking[] = $rank;
        }

        // コメント登録
        $ch = new CommentHandler();
        if(!empty($argv)) {
            $ch->registerComment(date: $argv[1], userId: $argv[2], comment:$argv[3]);
        }
        // 試合結果とコメントをマージ
        $results = $ch->mergeComment($results, $members);
        $results = repack_to_divide_by_year($results);

        // render
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader);
        $twig->addFunction($ordinalNumber);
        $background = $this->background;
        echo $twig->render('index.html', compact("whatis", "background", "results", "members", "ranking", "years"));
    }
}

$x = new Donguri();
$x->execute($argv ?? []);
