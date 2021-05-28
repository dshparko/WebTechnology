<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>

<?php

    $CONFIG = [

        'host' => "localhost",

        'username' => "root",

        'password' => '',

        'database' => 'lab5'
    ];


    $dblink = mysqli_connect($CONFIG["host"], $CONFIG["username"], $CONFIG["password"], $CONFIG["database"]) or die("Ошибка подключения к базе данных " . mysqli_error($link));
    if ($dblink == false)
{
    die("Ошибка: Невозможно подключиться к MySQL ");
}//else echo "Усппех";
    $query ="SELECT * FROM users";
    $result = mysqli_query($dblink, $query) or die("Ошибка запроса".mysqli_error($dblink)); 
    echo "Таблица:<br>";
    if($result)
    {
        $rows = mysqli_num_rows($result); // количество полученных строк
     
        echo "<table><tr><th>Id</th><th>Имя</th><th>Фамилия</th>";
        for ($i = 0 ; $i < $rows ; ++$i)
        {
            $row = mysqli_fetch_row($result);
            echo "<tr>";
                for ($j = 0 ; $j < 3 ; ++$j) echo "<td>$row[$j]</td>";
            echo "</tr>";
        }
        echo "</table>";
     
        // очищаем результат
        mysqli_free_result($result);
    }

    $query ="SELECT * FROM information";
    $result = mysqli_query($dblink, $query) or die("Ошибка запроса" . mysqli_error($dblink)); 
    echo "Вторая таблица:<br>";
    if($result)
    {
        $rows = mysqli_num_rows($result); // количество полученных строк
     
        echo "<table><tr><th>зарплата</th><th>работа</th><th>опыт</th><th>доп навыки</th></tr>";
        for ($i = 0 ; $i < $rows ; ++$i)
        {
            $row = mysqli_fetch_row($result);
            echo "<tr>";
                for ($j = 0 ; $j < 4 ; ++$j) echo "<td>$row[$j]</td>";
            echo "</tr>";
        }
        echo "</table>";
     
        // очищаем результат
        mysqli_free_result($result);
    }
    mysqli_close($dblink);
    // индивидуальное задание
    $CONFIGIND = [

        'host' => "localhost",

        'username' => "root",

        'password' => '',

        'database' => 'taskdb'
    ];
    
    
    
    $link = mysqli_connect($CONFIGIND["host"], $CONFIGIND["username"], $CONFIGIND["password"], $CONFIGIND["database"])
    or die("Ошибка подключения к базе данных " . mysqli_error($link));
    // удаляем таблицу
    $query ="DROP TABLE students";
    $result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));

    // создает таблицу
    $query ="CREATE TABLE taskdb.students
    (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(200) NOT NULL,
        groupnum INT,
        WT INT,
        OOP INT,
        OSISP INT,
        RPI INT,
        KSIS INT
    )"; 

    $result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link)); 
    if($result)
    {
        echo "Создание таблицы прошло успешно";
    }
    
    // создание строки запроса
    $querysinsert=[
        1 => "INSERT INTO students VALUES(Null,'Шпарко',951005,9,9,8,7,9)",
        2 => "INSERT INTO students VALUES(Null,'Макарушко',951005,7,6,10,7,9)",
        3 => "INSERT INTO students VALUES(Null,'Адамович',951005,9,5,6,8,9)",
        4 => "INSERT INTO students VALUES(Null,'Протасевич',951005,9,9,10,6,9)"
    ];
    for ($i=1;$i<=4;$i++){
        $result = mysqli_query($link, $querysinsert[$i]) or die("Ошибка " . mysqli_error($link)); 
    }

    // вывод таблицы студентов
    $query="SELECT * FROM students";
    $result = mysqli_query($link, $query) or die("Ошибка запроса" . mysqli_error($link)); 
    echo '<br><br>';
    echo "Студенты:<br>";
    //var_dump($result);
    $resultarray = mysqli_fetch_all($result);
    //var_dump($resultarray);
    echo 'Id Фамилия Группа 1 2 3 4 5 <br>';
    for ($i=0;$i<count($resultarray);$i++){
        for ($j=0;$j<count($resultarray[$i]);$j++){
            echo $resultarray[$i][$j];
            echo ' ';
        }
        echo '<br>';
    }
    echo '<br>';
    $title=[
        0 => "",
        1 => "",
        2 => "",
        3 => "WT",
        4 => "OOP",
        5 => "OSISP",
        6 => "RPI",
        7 => "KSIS"
    ];
    echo 'Студенты**:<br>';
    for ($i=0;$i<count($resultarray);$i++){
        $averagemark=0;
        $minmark=11;
        $minmarkind=-5;
        $maxmark=0;
        $maxmarkind=-5;
        $maxmarks = array();
        $minmarks = array();
        for ($j=0;$j<count($resultarray[$i]);$j++){
            echo $resultarray[$i][$j];
            echo " ";
            if ($j>2){
                $averagemark=$averagemark + $resultarray[$i][$j];
                if ($minmark > $resultarray[$i][$j]){
                    $minmark = $resultarray[$i][$j];
                    $minmarkind = $j;
                }
                if ($maxmark < $resultarray[$i][$j]){
                    $maxmark = $resultarray[$i][$j];
                    $maxmarkind = $j;
                }
            }
                
        }
        $averagemark=$averagemark/5;
        echo $averagemark;
        echo " ";
        echo "Предмет, по которому минимальная оценка: ";
        for  ($n=0;$n<count($resultarray[$i]);$n++){
            if ($resultarray[$i][$n]==$minmark)
            {
                echo $title[$n];
            }
        }
        
        echo ", ";
        echo $minmark;
        echo " Предмет, по которому максимальная оценка: ";
        for  ($n=0;$n<count($resultarray[$i]);$n++){
            if ($resultarray[$i][$n]==$maxmark)
            {
                echo $title[$n];
                echo ' ';
            }
        }
        echo ", ";
        echo $maxmark;
        echo "<br>";
        
    }
    mysqli_close($link);
    
?>
