<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="Main_styles.css" rel="stylesheet">
        <link href="icons.css" rel="stylesheet">
        <meta name="keywords" content="Портреты на заказ, Минск, Жлобин" >
        <title>Календарь</title>
    </head>
    <body>

      <div class="feedback about calendar">
        <h2>Календарь учебного года для определенного курса</h2>
        <form id="calen" action="calendar.php" method="get">
          <label>Год(4 цифры в интервале 1970-2100)<input id='y' type="text" name="year"  required pattern="^[1-2][0-9]{3}$"</label><br><br>
          <label>Курс(1 цифра от 1 до 4)<input id='k' pattern="^[1-4]$" type="text" required name="kurs"</label><br><br>
          <input type="submit" name="ok" value="Отправить"><br>
        </form>
      </div>

    </body>
</html>

