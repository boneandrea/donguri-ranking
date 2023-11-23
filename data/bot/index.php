<?php

declare(strict_types=1);

function return_challenge($json)
{
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($json);
    exit;
}

function l($s)
{
    error_log(print_r($s, true));
}

function update_excuse($json)
{
    try {
        l($json);
        $msg = $json["events"][0];
        $from = $msg["source"]["userId"];
        $text = $msg["message"]["text"];

        if(preg_match("/\A@ (.*)/", $text, $m)) {
            l("FOUND {$m[1]} from {$from}");
            $comment = escapeshellarg($m[1]);
            $userId = escapeshellarg($from);
            $date = escapeshellarg(date("Y/m/d"));

            chdir("/home/ubuntu/www-work/donguri");
            $r = null;
            $output = [];
            exec("./create_html $date $userId $comment", $output, $r);
            exec("cp index.html /var/www/html/junk/donguri/", $output, $r);
        }
    } catch(Exception $e) {
        l($e->getMessage());
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    exit;
}

try {
    $json = json_decode(file_get_contents("php://input") ?? "{}", true);
    // 認証時有効にする
    // Event Subscriptions
    $app_auth_challenge = true;
    $app_auth_challenge = false;
    if ($app_auth_challenge) {
        return_challenge($json);
    }

    update_excuse($json);

} catch(Exception $e) {
    //    l($e->getMessage());
}
