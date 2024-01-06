<?php
require __DIR__."/../vendor/autoload.php";

$results = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__."/results.yaml"), true);
usort($results, function($a, $b){
    $na=new DateTime($a["date"]);
    $nb=new DateTime($b["date"]);
    if ($na === $nb) return 0;
    return $na > $nb? 1 : -1;
});

$members=json_decode(file_get_contents(__DIR__."/users.json"), true);

$whatis=[
    "ゴロを打つ ゴロとかｗｗｗｗｗｗヘボｗｗｗｗｗ",
    "とにかく乗らない、60yに未だ誰も乗らない、どうしようもない",
    "なぜか入らない",
    "ラウンドしたらスコアカードをUPする",
    "100切ったら破門。先着1名は全員のおごりで本牧亭",
    "破門以降も参加可能。ただし昼飯バトルからは除外",
    "レディースハンデ for Aは廃止されました(2023/11/23)",
    "誕生月はハンデが1もらえます",
    "年間平均打数優勝者には何か商品が出ます（内容検討中）",
];
