<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <h2>Отправление рассылки</h2>
    <form action="index.php" method="get">
        <input type="text" name="title" placeholder="Заголовок сообщения"><br><br><br>
        <textarea rows="20" cols="35" name="message"></textarea>
        <input type="submit" name="submit" value="Отправить">
    </form>
</body>

</html>

<?php
if (isset($_GET['submit'])) {
    $subject = htmlspecialchars($_GET['title'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8');
    $message = htmlspecialchars($_GET['message'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8');
    require 'phpmailer/PHPMailer.php';
    require 'phpmailer/SMTP.php';
    require 'phpmailer/Exception.php';

    $CONFIG = [

        'host' => "localhost",

        'username' => "root",

        'password' => '',

        'database' => 'emaildb'
    ];
    $dblink = mysqli_connect($CONFIG["host"], $CONFIG["username"], $CONFIG["password"], $CONFIG["database"]) or die("Ошибка подключения к базе данных " . mysqli_error($link));

    $query = "SELECT email FROM es";
    $result = mysqli_query($dblink, $query) or die("Ошибка запроса" . mysqli_error($dblink));
    $rows = mysqli_num_rows($result);
    $resultarray = mysqli_fetch_all($result);
    echo "Emails from DataBase:<br>";
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < count($resultarray[$i]); $j++) {
            echo ' ';
            echo $resultarray[$i][$j];
        }
    }
    mysqli_close($dblink);
    echo '<br>';



    $mail = new PHPMailer\PHPMailer\PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP

    //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; 
    $mail->Host = "smtp.gmail.com";
    $mail->Username = 'dasha18shparko@gmail.com';
    $mail->Password = 'ab2564221';
    $mail->SMTPSecure = 'ssl'; //tls

    $mail->Port =  465; // or 587
    $mail->IsHTML(true);
    $mail->SetFrom('dasha18shparko@gmail.com', 'Darya');
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < count($resultarray[$i]); $j++) {
            $mail->AddAddress($resultarray[$i][$j]);
        }
    }
    //$mail->AddAddress('dasha18shparko@gmail.com');
    try {
        $mail->Body = $message;
        $mail->Subject = $subject;
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Email has been sent";
        }
    } catch (Exception $e) {
        print_r($e->getMessage());
    }
} else {
    echo 'bad post:(';
}

?>