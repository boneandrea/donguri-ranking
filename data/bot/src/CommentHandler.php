<?php

namespace Donguri;

require_once __DIR__.'/../../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

class CommentHandler
{
    public $comments = null;
    public $file = __DIR__."/../../comments.json";

    public function __construct()
    {
        $this->comments = $this->read();
    }

    public function registerComment($date, $userId, $comment)
    {
        $this->comments = $this->read();
        $items = array_filter($this->comments, fn ($e) => $e["date"] === $date && $e["userId"] === $userId);
        if(count($items) === 0) {
            $this->insert($date, $userId, $comment);
        } else {
            $this->update(array_pop($items)["id"], $comment);
        }
    }
    public function insert($date, $userId, $comment)
    {
        $id = Uuid::uuid4()->toString();
        $this->comments[] = compact("id", "date", "userId", "comment");
        $this->save();
    }

    public function update($id, $comment)
    {
        $_id = array_search($id, array_column($this->comments, "id"));
        $this->comments[$_id]["id"] = Uuid::uuid4()->toString();
        $this->comments[$_id]["comment"] = $comment;
        $this->save();
    }
    public function read()
    {
        return json_decode(file_get_contents($this->file), true);
    }
    public function save()
    {
        file_put_contents($this->file, json_encode($this->comments, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), LOCK_EX);
    }

    // results[] のscoresにcommentを埋め込む(joinのような処理)
    public function mergeComment(array $results, array $members): array
    {
        foreach($results as $i => $result) {
            foreach($result["score"] as $j => $s) {
                $comment = $this->getComment($result["date"], $s["name"], $members);
                if(!$comment) {
                    continue;
                }
                if($result["date"] !== $comment["date"]) {
                    continue;
                }
                // $user = $this->getUserInfoByName($s["name"], $members);
                // $game = $this->getGame($comment["date"], $results);
                $results[$i]["score"][$j]["excuse"] = $comment["comment"];
                // comment has userId
                // score has name
                // name -> userId
            }
        }
        $this->save();
        return $results;
    }

    public function getGame($date, $results)
    {
        $games = array_filter($results, fn ($e) => $e["date"] === $date);
        return empty($games) ? null : array_pop($games);
    }

    public function getComment($d, $n, $members)
    {
        // not name, use userId
        $user = $this->getUserInfoByName($n, $members);
        $items = array_filter($this->comments, fn ($e) => $e["date"] === $d && $e["userId"] === $user["userId"]);
        return empty($items) ? null : array_pop($items);
    }

    public function getUserInfoByName($name, $members)
    {
        if(!$name) {
            return [];
        }

        $users = array_filter($members, fn ($e) => $e["name"] === $name);
        if(!empty($users)) {
            return array_pop($users);
        }
        return [];
    }
}
