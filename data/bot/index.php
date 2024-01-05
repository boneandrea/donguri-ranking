<?php
declare(strict_types=1);

namespace Donguri;

require("vendor/autoload.php");

use Donguri\Bot\Bot;

function return_challenge(array $json=[])
{
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($json);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    exit;
}

try {
    $json = json_decode(file_get_contents("php://input") ?? "{}", true);
    $bot=new Bot();
    // 認証時有効にする
    // Event Subscriptions
    $app_auth_challenge = true;
    $app_auth_challenge = false;
    if ($app_auth_challenge) {
        return_challenge($json);
    }

    l($json);
    $bot->execute($json);

} catch(Exception $e) {
    l($e->getMessage());
}
