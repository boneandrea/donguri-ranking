<?php

require "../vendor/autoload.php";

$USER = "admin";
$PASS = "ruxorei8TieshooPh6ZeiTe3";

if(0) {
    switch (true) {
        case !isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']):
        case $_SERVER['PHP_AUTH_USER'] !== $USER:
        case $_SERVER['PHP_AUTH_PW']   !== $PASS:
            header('WWW-Authenticate: Basic realm="Enter username and password."');
            header('Content-Type: text/plain; charset=utf-8');
            die('このページを見るにはログインが必要です');
    }
}

require_once(__DIR__."/../data/data.php");
$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');
$twig = new \Twig\Environment($loader);
echo $twig->render("select_members.html", compact("members"));
