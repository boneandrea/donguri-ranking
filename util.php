<?php

function calculate_ranking_by_average(array $results, int $year){
    $_average=[];
    foreach($results as $game){
        if(!preg_match("/^$year/", $game["date"])) continue;
        if(isset($game["ignore_ranking"]) && $game["ignore_ranking"]) continue;
        foreach($game["score"] as $s){
            if(!isset($_average[$s["name"]])){
                $_average[$s["name"]] = [];
            }
            $_average[$s["name"]][]=$s["gross"];
        }
    }

    $average=[];
    foreach($_average as $name=>$scores){
        $ave=round(array_sum($scores)/count($scores),2);
        $average[]=compact("name","ave");
    }
    usort($average, function($a, $b){
        if ($a["ave"]===$b["ave"]) return 0;
        return $a["ave"] > $b["ave"] ? 1 : -1;
    });
    return compact("year","average");
}


function dump_ranking(array $ranking){
    foreach($ranking as $r){
        echo $r["name"]." ".$r["ave"]."\n";
    }
}

function repack_to_divide_by_year(array $result): array {
    $packed=[];
    foreach($result as $r){
        if(!preg_match("/(\d{4})\//", $r["date"], $m)) continue;
        if(!isset($packed[$m[1]])){
            $packed[$m[1]]=[];
        }
        $packed[$m[1]][]=$r;
    }
    return $packed;
}
