<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
            display: flex;
            flex-direction: column;
            align-content: center;
            justify-content: center;
            text-align: center;
            font-size: 20px;
        }

        .menu__list{
            
             display: flex;
            flex-direction: row;
            align-content: center;
            justify-content: center;
            list-style-type:none;
        }

        .menu__list > li {
            margin: 0 20px 0 20px;
        }

        .menu__list > li > input{
            background: #fba0e3;
            border-radius: 20px;
            font-size:20px;
            border:none;
            padding: 10px;
        }

        .menu__list > li > input:hover{
            
            cursor: pointer;
            background: #C71585;
        }
        </style>
</head>
<body>
    <form method="get">
        <nav class="menu">
            <ul class="menu__list">
                <li><input class="main" type="submit" name="main" id="main" value="Главная"/></li>
                <li><input class="products" type="submit" name="products" value="Услуги"/></li>
                <li><input class="news" type="submit" name="news" value="Новости"/></li>
                <li><input class="aboutus" type="submit" name="aboutus" value="О компании"/></li>
                <li><input class="contacts" type="submit" name="contacts" value="Контакты"/></li> 
            </ul>
        </nav>
        
    </form>
    <?php

    function select($id){
        echo "<style>  
                    .$id {
                        background: #C71585;
                    }
                </style>";
    }
    
    function main_func(){
        echo "<h1> Введите через пробел элементы массива:</h1>
                    <form method='GET'>
                    Массив : <input type='text' name='first_array'/>
                    <input type='submit'/>
                    </form>";
        if(array_key_exists("first_array",$_GET)){
            if($_GET["first_array"] == "" ){
                echo "<h1>Массив пуст!</h1>";
                return;
            }

            $first_array=$_GET["first_array"];
            echo "Исходный массив: ".$first_array."</br>";
            $index=0;
            $second_array = [];
            $temp = "";
            //разбиение строки на элементы массива
            if ($first_array[0] != ' ') {
                $temp .= $first_array[0];
            }
            for ($j = 1; $j < strlen($first_array); $j++) {
                if ($first_array[$j] != ' ') {
                    $temp .= $first_array[$j];
                    //$array[$name[$j]] = $name[$j];
                }
                if ($j == strlen($first_array) - 1 || ($first_array[$j] == ' ' && $first_array[$j - 1] != ' ')) {
                    $array[$index] = $temp;
                    $index++;
                    $second_array[$temp] = $temp;
                    $temp = "";
                }
            }
    //данные исходного массива
    /*foreach($array as $value){
        echo $value." ";
    }*/
    //массив без дубликатов
            echo "</br>Итоговый массив: ";
            foreach ($second_array as $value) {
            echo $value . " ";
            } 
        }
    }

    function products_func(){
        echo "<h1>Услуги</h1>";
    }

    function news_func(){
        echo "<h1>Новости</h1>";
    }

    function aboutus_func(){
        echo "<h1>О компании</h1>";
    }

    function contacts_func(){
        echo "<h1>Контакты</h1>";
    }

    if(array_key_exists('main',$_GET)){
        main_func();
        select("main");
    }

    if(array_key_exists('first_array',$_GET)){
        main_func();
        select("main");
    }

    if(array_key_exists("products",$_GET)){
        products_func();
        select("products");
    }

    if(array_key_exists("news",$_GET)){
        news_func();
        select("news");
    }

    if(array_key_exists("aboutus",$_GET)){
        aboutus_func();
        select("aboutus");
    }
    if(array_key_exists("contacts",$_GET)){
        contacts_func();
        select("contacts");
    }
    ?>
</body>
</html>