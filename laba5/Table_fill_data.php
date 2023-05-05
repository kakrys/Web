<?php
session_start();

if (isset($_POST))
{
    $mysqli = new  mysqli('db','root','helloworld','web');
    $descr = ['name'];

    $name  = $_POST['name'];
    $salary = $_POST['salary'];
    $age = $_POST['age'];
    $smth = $_POST['smth'];

    $mysqli->query("INSERT INTO table_web (name,salary,age,smth) VALUES ('$name','$salary','$age','$smth')");
    $mysqli->close();

    header('Location: /tabl.php');
    exit();
}
?>
