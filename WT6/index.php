<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
<?php

session_start();

if (empty($_SESSION['count'])) {
   $_SESSION['count'] = 1;
   date_default_timezone_set('Europe/Minsk');
   $date = date('m/d/Y h:i:s a', time());
   $_SESSION['dates'] = array();
   $_SESSION['dates'][$_SESSION['count']-1] = $date;

} else {
   $_SESSION['count']++;
   $date = date('m/d/Y h:i:s a', time());
   $_SESSION['dates'][$_SESSION['count']-1] = $date;
}
?>

<p>
    Посетитель, вы видели эту страницу <?php echo $_SESSION['count']; ?> раз.
    <?php
        echo '<br>'; 
        echo '<span height="15">Время посещений:</span><br>';
        foreach(($_SESSION['dates']) as $value){
            echo $value;
            echo '<br>';
        } 
    ?> 
</p>