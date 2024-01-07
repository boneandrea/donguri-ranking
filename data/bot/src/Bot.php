<?php

declare(strict_types=1);

namespace Donguri\Bot;

require("util.php");

class Bot
{
    public function __construct()
    {
    }

    public function execute(array $json)
    {
        $this->update_excuse($json);
        $msg = $json["events"][0];
        // $from = $msg["source"]["userId"];
        $text = $msg["message"]["text"];

        l($text);
        l($text);
        l($text);
    }

    public function update_excuse($json)
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
}
