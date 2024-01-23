<?php

declare(strict_types=1);

/*
 * _l
 *
 * @SuppressWarnings(PHPMD.DevelopmentCodeFragment)
 */
function l($s)
{
    error_log(print_r($s, true)."\n");
}
function calculate_ranking_by_average(array $results, int $year)
{
    $_average = [];
    foreach($results as $game) {
        if(!preg_match("/^$year/", $game["date"])) {
            continue;
        }
        if(isset($game["ignore_ranking"]) && $game["ignore_ranking"]) {
            continue;
        }
        foreach($game["score"] as $s) {
            if(!isset($_average[$s["name"]])) {
                $_average[$s["name"]] = [];
            }
            $_average[$s["name"]][] = $s["gross"];
        }
    }

    $averages = [];
    foreach($_average as $name => $scores) {
        $count = count($scores);
        $average = round(array_sum($scores) / $count, 2);
        $averages[] = compact("name", "average", "count");
    }
    usort($averages, function ($a, $b) {
        if ($a["average"] === $b["average"]) {
            return 0;
        }
        return $a["average"] > $b["average"] ? 1 : -1;
    });

    return compact("year", "averages");
}


function dump_ranking(array $ranking)
{
    foreach($ranking as $r) {
        echo $r["name"]." ".$r["ave"]."\n";
    }
}

function repack_to_divide_by_year(array $result): array
{
    $packed = [];
    foreach($result as $r) {
        if(!preg_match("/(\d{4})\//", $r["date"], $m)) {
            continue;
        }
        if(!isset($packed[$m[1]])) {
            $packed[$m[1]] = [];
        }
        $packed[$m[1]][] = $r;
    }
    return $packed;
}
