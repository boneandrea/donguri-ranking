<?php
$USER = "admin";
$PASS = "ruxorei8TieshooPh6ZeiTe3";

switch (true) {
    case !isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']):
    case $_SERVER['PHP_AUTH_USER'] !== $USER:
    case $_SERVER['PHP_AUTH_PW']   !== $PASS:
        header('WWW-Authenticate: Basic realm="Enter username and password."');
        header('Content-Type: text/plain; charset=utf-8');
        die('このページを見るにはログインが必要です');
}

require_once(__DIR__."/data/data.php");
require_once(__DIR__."/data/bot/src/post_line.php");
// require_once(__DIR__."/data/commentHandler.php");
// require_once(__DIR__."/util.php");

use Symfony\Component\Yaml\Yaml;

session_start();
if($_SERVER["REQUEST_METHOD"] === "POST") {
    register_score($results);
    post("score更新しました: https://peixe.biz/junk/donguri/");
    header("Location: .");
    exit();
}

// GET
if(isset($_SESSION["append_data"])) {
    $post_result = $_SESSION["append_data"];
    unset($_SESSION["append_data"]);
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"/>
        <title>底辺データ登録</title>
        <script>
         const q = s => document.querySelector(s);
         const qa = s => document.querySelectorAll(s);
         const qaa = s => Array.from(qa(s));
        </script>
        <style>
         .hide{ display: none; }
         .changed{ color: red; }
        </style>
    </head>
    <body>
        <div class="container">
            <?php if ($post_result === 1):?>
                <div class="alert alert-danger" role="alert">
                    データ登録失敗
                </div>
            <?php endif;?>
            <?php if ($post_result === 2):?>
                <div class="alert alert-success" role="alert">
                    データ登録成功
                </div>
            <?php endif;?>
            <h1>どんぐりデータ入力</h1>
            <div>
                <form method="post">
                    <div class="form-group">
                        <input type="date" name="date" value="<?=date('Y-m-d')?>" class="form-control" />
                    </div>
                    <div class="mb-3 form-check">
                        <input type="hidden" name="ignore_ranking" value="0" />
                        <input id="ignore_ranking" type="checkbox" name="ignore_ranking" value="1" class="form-check-label" />
                        <label for="ignore_ranking">ランキングに含めない</label>
                    </div>
                    <div class="form-group">
                        <input name="place" placeholder="場所など特記事項" class="form-control" />
                    </div>
                    <?php foreach($members as $index => $member):?>
                        <div class="row mb-3">
                            <label for="inputScore<?=$index?>" class="col-sm-1 col-form-label"><?=$member["name"]?></label>
                            <div class="col-sm-11">
                                <input name="gross[]" type="number" class="score form-control" id="inputScore<?=$index?>" min="0" value="">
                                <span class="hide changed">Changed</span>
                            </div>
                            <input name="name[]" type="hidden" value="<?=$member['name']?>" class="form-control" >
                        </div>
                    <?php endforeach;?>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary">
                    </div>
                </form>
                <hr>
                <hr>
                <hr>
                <button type="button" class="btn btn-danger">Reset</button>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script
            src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"
        ></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="./manage.js"></script>
    </body>
</html>
<?php
/** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
function d($data)
{
    // echo "<pre>";
    // var_dump($data);
    // echo "</pre>";
}

function parse_data()
{
    $data = $_POST;

    $result = [];
    foreach($data["name"] as $index => $name) {
        if(empty($data["gross"][$index])) {
            continue;
        }
        $result[] = [
            "name" => $name,
            "gross" => (int)$data["gross"][$index],
        ];
    }
    $data["score"] = $result;
    $data["date"] = preg_replace("/\-/", "/", $data["date"]);

    unset($data["name"]);
    unset($data["gross"]);
    return $data;
}

function append_data(array $data, array $results)
{
    $results[] = $data;
    $yaml = Yaml::dump($results, 2);
    return file_put_contents(__DIR__."/data/results.yaml", $yaml, LOCK_EX);
}

function register_score(array $results): void
{
    $data = parse_data();
    $r = append_data($data, $results);
    $_SESSION["append_data"] = $r === false ? 1 : 2;

    chdir("/home/ubuntu/www-work/donguri");
    $r = null;
    $output = [];
    exec("./update", $output, $r);
}
