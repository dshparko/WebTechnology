<?php $server = '127.0.0.1';
$Studentname = 'root';
$password = '';
$db = 'test';
$n = htmlspecialchars($_GET["n"]);
$link = new mysqli($server, $Studentname, $password, $db);
$query = "SELECT id,path,count FROM pixel
                WHERE id =$n
                LIMIT 1";
$img = mysqli_fetch_all(mysqli_query($link, $query), MYSQLI_ASSOC)[0];
$count = $img['count'] + 1;
$id = $img['id'];
$query = "UPDATE pixel
                SET count=$count    
                WHERE id=$id";
mysqli_query($link, $query);
header('Content-type: image/png');
echo readfile($img["path"]);