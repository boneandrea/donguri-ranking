<?php

function post(string $msg)
{
    $token = "lR8Mig0KKaszf60KHIl2ihwGBqsgM8Cf5KAcWOL0oyRPzJWHkjQY4bYQXsFc02WBn3wGIKSjdrNrd/osI3dhxtD6EWe81cwXdfHZZOod7VuJ5cR4PlIuibdqTGrXPdkxHb7PQPPY7ZgKMtmHr8YQFwdB04t89/1O/w1cDnyilFU=";
    $data = [
        "to" => "Cb9527f7a26d42d7e0ea6e20982f14c88",
        "messages" => [
            [
                "type" => "text",
                "text" => $msg
            ]
        ]
    ];
    $url = "https://api.line.me/v2/bot/message/push";
    $header = [
        'Authorization: Bearer '.$token,  // 前準備で取得したtokenをヘッダに含める
        'Content-Type: application/json',
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header); // リクエストにヘッダーを含める
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_exec($ch);
    curl_close($ch);
}
