<?php
require __DIR__ . '/vendor/autoload.php';

function path(){
    $dir = 'categories/';
    $cateroty_mas = scandir($dir);
    unset($cateroty_mas[0]);
    unset($cateroty_mas[1]);
    return $cateroty_mas;
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
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .my_button{
            width: 100px;
            height: 30px;
        }
        .my_select{
            width: 100px;
            height: 30px;
        }
    </style>
</head>
<body>
    <form action="lab_3_2_A.php" method="post">
        # 2.A <br>
        <textarea rows="10" name="Our_text"></textarea>
        <input type="submit" value="Save_2.A" class="my_button">
        <br>
    </form>
        # 2.B <br>
    <form action="lab_3_2_B.php" method="post">
        <label>Ваше имя: <input type="text" name="Name"></label>
        <label>Ваша фамилия: <input type="text" name="Surname"></label>
        <label>Ваш возраст: <input name="Age"></label>
        <button class="my_button">Save to session</button><br>
        <a href="index3_2_B.php">Go to index_2_2</a> # Сохраняем ссылку на index_2, где выводим данные из session
        <br>
    </form>
        # 2.C <br>
    <form action="lab_3_2_C.php" method="post">
        <label>Ваше имя: <input type="text" name="Name"></label>
        <label>Ваша зарплата: <input type="text" name="Your_Cash"></label>
        <label>Ваш возраст: <input name="Age"></label>
        <label>Место работы: <input name="Work_Area"></label>
        <button class="my_button">Save to session</button><br>
        <a href="index3_2_C.php">Go to index_2_3</a>
        <br>
    </form>
    # 3 <br>
    <div id="form">
    <form action="lab_3_3_A.php" method="post">
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
            $client = new Google_Client();
            $client->setApplicationName('Google Sheets in PHP');
            $client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
            $client->setAccessType('offline');
            $client->setAuthConfig(__DIR__ . '/credentials.json');
            $service = new Google_Service_Sheets($client);
            $range = 'A1:C1';
            $range1 = 'A2:C15';
            $data = [
                [
                    'Category', 'Title', 'Text'
                ]
            ];

            $values = new Google_Service_Sheets_ValueRange([
                'values'=>$data
            ]);
            $options = [
                'valueInputOption'=> 'RAW'
            ];
            $spreadsheetId = '1OA1jc2-_hL5NX9GExWDkKxJWrgyb4dIRQ-aykvRKKk8';

            $service->spreadsheets_values->update($spreadsheetId, $range, $values, $options);

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
