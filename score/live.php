<?php

require "../vendor/autoload.php";

/*
 * _l
 *
 * @SuppressWarnings(PHPMD.DevelopmentCodeFragment)
 */
function l($s)
{
    error_log(print_r($s, true)."\n");
}

function create_file($round_id, $members)
{
    $initial_data = array_map(
        fn ($m) => [
        "name" => $m,
        "score" => array_fill(0, 18, 0)
    ],
        $members
    );
    file_put_contents(__DIR__."/round/{$round_id}.json", json_encode($initial_data));

    update_html($round_id);
}

function create_round_id()
{
    return hash("sha256", date("YmdHis"));
}

function update_score($data)
{
    $file = __DIR__."/round/{$data['round_id']}.json";
    l($file);
    l($data["score"]);
    file_put_contents($file, json_encode($data["score"]), LOCK_EX);
}

function read_score($round_id)
{
    $json = __DIR__."/round/{$round_id}.json";
    return json_decode(file_get_contents($json));
}

function update_html($round_id)
{
    $scores = read_score($round_id);
    $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');
    $twig = new \Twig\Environment($loader);
    $file = __DIR__."/round/{$round_id}.html";
    file_put_contents($file, $twig->render('index.html', compact("scores")));
}

function notify_to_line($round_id)
{
    l($round_id);
    // TODO: post to LINE group
}


$data = json_decode(file_get_contents("php://input"), true);
$ret = [];
if($data["start"] ?? false) {
    $round_id = create_round_id();
    create_file($round_id, $data["members"]);
    l("start round: generate url; {$round_id}");
    $ret["round_id"] = $round_id;
} else {
    if($round_id = $data["round_id"] ?? false) {
        l("startED round: $round_id");
        update_score($data);
        update_html($round_id);
        notify_to_line($round_id);
    }
}

header("Content-type: application/json");
echo json_encode($ret);
