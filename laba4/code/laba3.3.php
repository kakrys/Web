<?php
session_start();
function redirect(){
    header('Location: /');
    exit();
}
if (false === isset($_POST["Email"], $_POST["Title_of_announcement"],
        $_POST["Text_of_announcement"], $_POST["Category"])){
    redirect();
}


$category = $_POST["Category"];
$title = $_POST["Title_of_announcement"];
$text = $_POST["Text_of_announcement"];



$filePath = "categories/{$category}/{$title}.txt";

if (false === file_put_contents($filePath, $text)){
    throw new Exception("Something wrong");
}
redirect();