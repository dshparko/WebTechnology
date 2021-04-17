  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab4</title>

    <style>
    body{
        font-family: "Helvetica";
        text-align: center;
        align-items: center;
    }
    </style>
</head>

<body>        
    <form method="post">
 Загрузить файл:<br><br>
 <input name="filename" type="file"><br><br>
 <input type="submit" value="Отправить">
</form><br>
  <?php
    if (array_key_exists("filename",$_POST)&&$_POST["filename"]!=null){
        $fileName= htmlentities($_POST["filename"]);
        $text = file_get_contents($_POST['filename']);
        $text = preg_replace('/\n/',"\n<br>\n",$text);
        echo $text . '<br><br>';
        $text = preg_replace_callback_array(
            [
                '/((?<=\s|^)(([1-9])|([1-2][0-9])|(3[01]))\/(([1-9])|(1[0,2]))\/([1-9][0-9]{1,3})(?=\s|$))/' => function ($temp) {
                    $buffer = (explode("/",$temp[0]))[2];
                    $tmp=(int)$buffer;
                    $tmp++;
                    $temp[0] = substr_replace($temp[0], $tmp, strlen($temp[0])-strlen($buffer),strlen($temp[0]));
                    return "<span style='color: red;'>" . preg_filter('/\//','.',$temp[0]). "</span>";
                },
                '/((?<=\s|^)(([1-9])|([1-2][0-9])|(3[01]))\.([1-9]|1[0,2])\.([1-9][0-9]{1,3})(?=\s|$))/' => function ($temp) {
                    $buffer = (explode(".",$temp[0]))[2];
                    $tmp=(int)$buffer;
                    $tmp++;
                    $temp[0] = substr_replace($temp[0], $tmp, strlen($temp[0])-strlen($buffer),strlen($temp[0]));
                    return "<span style='color: red;'>". $temp[0]. "</span>";
                }
            ],
            $text
        );
        echo $text;
    }
  ?>

</body>
</html>