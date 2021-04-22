  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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

    function Check_reg1($str)
    {
        // MM/DD/YYYY
        $reg1='/([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{2,4})/';
        if (preg_match($reg1, $str, $matches)) 
        {
            if (!checkdate($matches[1], $matches[2], $matches[3])) 
            {
                return false;
            }
            else {return true;}
                
        }
        else {return false;}
            
    }
    function Check_reg2($str)
    {
        //DD.MM.YYYY
        $reg2='/([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{2,4})/';
        if (preg_match($reg2, $str, $matches)) 
        {
            if (!checkdate($matches[2], $matches[1], $matches[3])) 
            {
                if ($matches[3]=='00')
                    return true;
                else
                    return false;
            }
            else {return true;}
                
        }
        else 
        {
            return false;
        }
            
    }

    if (array_key_exists("filename",$_POST)&&$_POST["filename"]!=null){
        $fileName= htmlentities($_POST["filename"]);
        $alltext = file_get_contents($_POST['filename']);
        $alltext = preg_replace('/\n/',"\n<br>\n",$alltext);
        echo $alltext . '<br><br>';

        echo '<br>';
        // заменяем формат со слешами на точечный
        $alltext=preg_replace('/([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{2,4})/','$2.$1.$3',$alltext);
        // получаем все даты
        preg_match_all('/([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{2,4})/',$alltext,$dates);
        $split_text = preg_split("/[\s,]+/", $alltext);
        $dates=$dates[0];
        // добавляем ко всем датам 1
        foreach($dates as &$value)
        {
            $buffer = (explode(".",$value))[2];
            $tmp=(int)$buffer;
            $tmp++;
            $value = substr_replace($value, $tmp, strlen($value)-strlen($buffer),strlen($value));
        }

        $count_date=count($dates);
        $count_text=count($split_text);
        $curdate=0;
        echo '<br>';
        for ($i=0; $i < $count_text; $i++)
        {
            if(Check_reg2($split_text[$i])){
                $split_text[$i]=preg_replace('/([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{2,4})/',$dates[$curdate],$split_text[$i]);
                $curdate++;
            }        
        }
        
        for ($i=0; $i < $count_text; $i++)
        {
            $split_text[$i]=preg_replace('/([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{2,4})/','<span>$1.$2.$3</span>',$split_text[$i]);
        }
        
        echo '<style media="screen">
        span {
           color: red;
        }
        </style>';    
        
        for ($j=0; $j< $count_text; $j++){
            echo $split_text[$j];
            echo " ";
        }
       
    }
  ?>

</body>
</html>