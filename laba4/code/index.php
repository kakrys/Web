<?php
function path(){
    $dir = 'categories/';
    $category_mas = scandir($dir);
    unset($category_mas[0]);
    unset($category_mas[1]);
    return $category_mas;
}
function fullpath()
{
    $category_mas = path();
    $mas = [];
    for ($i = 0; $i < sizeof($category_mas); $i++){
        $mas[$i] = [];
    }
    $count = 0;
    for ($i = 0; $i < sizeof($category_mas); $i++) {
        $dir = "categories/{$category_mas[$i+2]}";
        $path_to_txt = scandir($dir);
        unset($path_to_txt[0]);
        unset($path_to_txt[1]);
        for ($q = 0; $q < sizeof($path_to_txt); $q++) {
            $mas[$i+2][$category_mas[$i+2]][] = $path_to_txt[$q+2];
            $count +=1 ;
        }
    }
    var_dump($mas);
    return [$mas, $count];  // возвращаем массив категорий и файлов
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>3.2</title>
</head>
<body>
    # 2.A
    <form name="text" method="POST" action="laba3.2A.php">
         <label>Введите сообщение: <input type="text" name="text"></label>
         <input type="submit" name="send" value="Отправить">
        <br>
    </form>
    <br>

    # 2.B
    <form name="text" method="POST" action="laba3.2B.php">
        <label>Ваше имя: <input type="text" name="Name"></label>
        <label>Ваша фамилия: <input type="text" name="Surname"></label>
        <label>Ваш возраст: <input name="Age"></label>
        <button class="my_button">Сохранить</button>
    <a href="index3.2B.php">Переход на другую страницу</a>
    </form>
    <br>

    # 2.C
    <form name="text" method="POST" action="laba3.2C.php">
        <label>Ваше имя: <input type="text" name="Name"></label>
        <label>Ваш возраст: <input name="Age"></label>
        <label>Ваша зарплата: <input name="Salary"></label>
        <label>Ваш пол: <input name="Gender"></label>
        <button class="my_button">Сохранить</button>
    <a href="index3.2C.php">Переход на другую страницу</a>
    </form>

    # 3 <br>
    <div id="form">
        <form action="laba3.3.php" method="post">
            <label>Ваш email: <input type="email" name="Email" required></label>
            <label>Название обьявления: <input type="text" name="Title_of_announcement" required></label>
            <label>Текст обьявления: <textarea rows="10" name="Text_of_announcement" required></textarea></label>
            <label>Категория <select name="Category" class="my_select" required>
                    <?php
                    $cateroty_mas = path();
                    foreach ($cateroty_mas as $value){
                        ?>
                        <option value=<?php echo $value;?>>
                            <?php echo $value; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </label>
            <input type="submit" value="Save_3" class="my_button"><br>
        </form>
    </div>
    <div id="table">
        <table>
            <thead>
            <th>Категория</th>
            <th>Заголовок</th>
            <th>Описание</th>
            </thead>
            <tbody>
            <?php
            $tmp = fullpath();
            $mas = $tmp[0]; $count = $tmp[1];
            foreach ($mas as $j => $value){
                if($value != null){
                    foreach ($value as $cat => $znach){
                        foreach ($znach as $q => $title){
                            $path = "categories/{$cat}/{$title}";
                            $text = file_get_contents($path);
                            $title = trim($title, ".txt");
                            ?>
                            <tr>
                                <td><?php echo $cat; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $text; ?></td>
                            </tr>
                            <?php
                        }
                    }
                }
            }
            ?>
            <tr>
                <td> </td>
                <td> </td>
                <td> </td>
            </tr>
            </tbody>
        </table>
    </div>
</body>
</html>