<?php

declare(strict_types=1);

namespace Donguri;

require("util.php");

class Bot
{
    public function __construct()
    {
    }

    public function send()
    {
        echo file_get_contents(__DIR__."/../messages/message1.json");
    }

    public function execute(array $json)
    {
        $msg = $json["events"][0];
        $from = $msg["source"]["userId"];
        $text = $msg["message"]["text"];
        $this->update_excuse($text, $from);
    }

    public function update_excuse(string $text, string $from)
    {
        try {
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
            if(preg_match("/\Aベスト.*(\d+)/", $text, $m)) {
                l("FOUND {$m[1]} from {$from}");
                // $best = escapeshellarg($m[1]);
                // $userId = escapeshellarg($from);
                // $date = escapeshellarg(date("Y/m/d"));

                // chdir("/home/ubuntu/www-work/donguri");
                // $r = null;
                // $output = [];
                // exec("./create_html $date $userId $comment", $output, $r);
                // exec("cp index.html /var/www/html/junk/donguri/", $output, $r);
            }
        } catch(Exception $e) {
            l($e->getMessage());
        }
    }
}
