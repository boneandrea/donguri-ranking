<?php

require __DIR__."/../vendor/autoload.php";

$results = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__."/results.yaml"), true);


function sort_by_date($results)
{
    usort($results, function ($a, $b) {
        $na = new DateTime($a["date"]);
        $nb = new DateTime($b["date"]);
        if ($na === $nb) {
            return 0;
        }
        return $na > $nb ? 1 : -1;
    });
}

function sort_by_score($results)
{
    foreach(array_keys($results) as $k) {
        usort($results[$k]["score"], function ($a, $b) {
            if ($a["gross"] === $b["gross"]) {
                return 0;
            }
            return $a["gross"] > $b["gross"] ? 1 : -1;
        });
    }
    return $results;
}
sort_by_date($results);
$results = sort_by_score($results);
$members = json_decode(file_get_contents(__DIR__."/users.json"), true);

$whatis = [
    "ゴロを打つ ゴロとかｗｗｗｗｗｗヘボｗｗｗｗｗ",
    'とにかく乗らない、<s>60yに未だ誰も乗らない、どうしようもない</s><br><b class="text-danger">&rarr;もはや余裕で1onのパー</b>',
    "なぜか入らない",
    '100切ったら<b class="text-danger">破門</b>&rarr;<b>顧問</b>に就任。先着1名は全員のおごりで本牧亭&rarr;<b>名誉顧問</b>',
    "ラウンドしたらスコアカードをUPする",
    "破門以降も参加可能。ただし昼飯バトルからは除外",
    "レディースハンデ for Aは廃止されました(2023/11/23)",
    "誕生月はハンデが1もらえます",
    "年間平均打数優勝者には何か商品が出ます（内容検討中）",
    "昼飯は上限5000円",
];
