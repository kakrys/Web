<?php
session_start();

function redirect(){
    header('Location: /');
    exit();
}

if (isset($_POST))
{
    $mas = [["Name", $_POST["Name"]],["Salary", $_POST["Salary"]],
        ["Age", $_POST["Age"]], ["Gender", $_POST["Gender"]]];
    $_SESSION["Info"] = $mas;
    redirect();
}