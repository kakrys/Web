<?php
//2A

if (isset($_POST)) {
    $arr = $_POST['text'];
    $f = explode(" ", $arr);
    echo "Количество слов = ",(count($f)),"\n";
    $count=0;
    for ($i=0; $i<sizeof($f); $i++)
    {
        $count+=strlen($f[$i]);
    }
    echo "Количество символов = ",$count , "\n";
}
