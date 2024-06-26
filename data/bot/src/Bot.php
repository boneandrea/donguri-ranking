<?php

declare(strict_types=1);

namespace Donguri;

require_once __DIR__.'/util.php';
require_once __DIR__.'/post_line.php';
use Donguri\Data;

class Bot
{
    public function __construct()
    {
        $this->data = new Data();
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
                $this->excuse($m, $from, $text);
            }
            if(preg_match("/\Aベスト[^\d]*(\d+)/", $text, $m)) {
                $this->best($m, $from);
            }
        } catch(Exception $e) {
            l($e->getMessage());
        }
    }

    public function excuse(array $m, ?string $from)
    {
        l("FOUND {$m[1]} from {$from}");
        $comment = escapeshellarg($m[1]);
        $userId = escapeshellarg($from);
        $date = escapeshellarg(date("Y/m/d"));

        $this->recreate_html($date, $userId, $comment);
        post("言い訳登録しました: https://peixe.biz/junk/donguri/");
    }

    public function best(array $m, ?string $from)
    {
        $best = intval($m[1]);
        $members = $this->data->read(__DIR__."/../../users.json");
        $userIndex = array_search($from, array_column($members, "userId"));
        $members[$userIndex]["best"] = $best;
        $this->data->write_json(__DIR__."/../../users.json", $members);
        $this->recreate_html(null, null, null);
        post("ベストスコア更新しました: https://peixe.biz/junk/donguri/");
    }

    public function recreate_html(?string $date, ?string $userId, ?string $comment)
    {
        chdir("/home/ubuntu/www-work/donguri");
        $r = null;
        $output = [];
        exec("./create_html $date $userId $comment", $output, $r);
        exec("cp index.html /var/www/html/junk/donguri/", $output, $r);
    }
}
