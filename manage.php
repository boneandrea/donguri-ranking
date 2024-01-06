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
// require_once(__DIR__."/data/commentHandler.php");
// require_once(__DIR__."/util.php");

use Symfony\Component\Yaml\Yaml;

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = parse_data();
    append_data($data, $results);
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
        <title>Hello, world!</title>
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
            <h1>どんぐりデータ入力</h1>
            <div>
                <form method="post">
                    <div class="form-group">
                        <input type="date" name="date" value="<?=date('Y-m-d')?>" class="form-control" />
                    </div>
                    <div class="mb-3 form-check">
                        <input type="hidden" name="ignore" value="0" />
                        <input id="ignore" type="checkbox" name="ignore" value="1" class="form-check-label" />
                        <label for="ignore">ランキングに含めない</label>
                    </div>
                    <div class="form-group">
                        <input name="place" placeholder="場所など特記事項" class="form-control" />
                    </div>
                    <?php foreach($members as $member):?>
                        <!--
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label" for="lg">form-group-lg</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" id="lg">
                            </div>
                        </div>
                        -->
                        <label>
                            <?=$member["name"]?>
                        </label>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <input name="gross[]" type="number" class="score form-control" min="0" value="">
                                </div>
                                <div class="col-sm-2">
                                    <span class="hide changed">Changed</span>
                                </div>
                                <input name="name[]" type="hidden" value="<?=$member['name']?>" class="form-control" >
                            </div>
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
    file_put_contents(__DIR__."/data/results.yaml", $yaml);
}
