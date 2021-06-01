<html lang="ru">

<head>
  <meta charset="utf-8">

  <title>lab8</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <meta name="theme-color" content="#7952b3">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
</head>

<body>


  <main>

    <div class="album py-5 bg-light">
      <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <div class="col">
            <div class="card shadow-sm">
              <img src="./pixel.php?n=5" alt="">
            </div>
          </div>
          <div class="col">
            <div class="card shadow-sm">
              <img src="./pixel.php?n=4" alt="">
            </div>
          </div>
          <div class="col">
            <div class="card shadow-sm">
              <img src="./pixel.php?n=3" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>
  <div style="width: 60%;margin:auto;">
    <?php
    $server = '127.0.0.1';
    $Studentname = 'root';
    $password = '';
    $db = 'test';
    $link = new mysqli($server, $Studentname, $password, $db);
    $query = "SELECT path,count FROM pixel";
    $img = mysqli_fetch_all(mysqli_query($link, $query), MYSQLI_ASSOC);
    echo <<< EOT
        <table class="table table-striped" style=" border: 4px double LightGrey;" id="table">
        <thead>
          <tr>
            <th scope="col">Image</th>
            <th scope="col">Counter</th>
          </tr>
         </thead>
         <tbody> 
EOT;
    foreach ($img as $x) {
      $p = $x["path"];
      $c = $x["count"];
      echo <<< EOT
            <tr>
              <td ><img src="$p" alt="" style="height:150px;width:auto;"></td>
              <td>$c</td>
            </tr>
EOT;
    }
    ?>
  </div>


</body>

</html>