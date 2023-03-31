<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="laba3.2B.php" method="get">
        <?php
        //2B
        echo "2B", "<br>";
        echo "Имя:", $_SESSION["Name"], "<br>";
        echo "Фамилия:", $_SESSION["Surname"], "<br>" ;
        echo "Возраст:", $_SESSION["Age"] , "<br>";
        ?>
    </form>
</body>
</html>