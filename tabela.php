<?php

  $con = mysqli_connect("fdb32.awardspace.net", "4106404_produkty", "produkty1", "4106404_produkty");
  if(mysqli_connect_errno())
  { echo "Wystąpił błąd połączenia z bazą danych"; }
  mysqli_query($con, "SET NAMES utf8");
  
  // var_dump($_POST);

  $name = $_POST['name'];
  $age = $_POST['age'];
  $attempts = $_POST['attempts'];
  
  $query = 'INSERT INTO Wyniki(Login, Wiek, Wynik) VALUES ("'.$name.'", '.$age.', '.$attempts.');';
  mysqli_query($con, $query);
  
  echo "<h3>Dziękujemy za dodanie do bazy!</h3><br>";
  echo '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Database-icon.svg/706px-Database-icon.svg.png"
  height="400px" width="300px" alt="A tu powinna być baza danych"><br>';
  echo "<h2>Najlepsi z najlepszych</h2>";
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabela najlepszych</title>
  <style>
    body {
      background-color: darkSlateGray;
      margin-right: auto;
      margin-left: auto;
      text-align: center;
      color: white;
    }
    table {
      margin-left: auto;
      margin-right: auto;
    }
    td, th {
      padding-left: 10px;
      padding-right: 10px;
      font-size: 30px;
      text-align: center;
    }
    button {
      margin: 20px;
      height: 30px;
      width: 140px;
      cursor: pointer;
      border-radius: 20px; 
      background-color: white;
    }
    button:hover {
      border: 2px solid #40ff00;
    }
  </style>
</head>
<body>
  <?php
    $result = mysqli_query($con, "SELECT * FROM Wyniki ORDER BY Wynik");
    
    $rows_num = mysqli_num_rows($result);
    
    echo '<table><b><tr><th>Miejsce</th><th>Login</th><th>Wiek</th><th>Wynik</th></tr></b><hr>';
          
    if ($rows_num > 10) {
      for ($i = 1; $i < 11; $i++) {
        $row = mysqli_fetch_array($result);
        echo "<tr><td>".$i."</td><td>".$row['Login']."</td><td>".$row['Wiek']."</td> <td>".$row['Wynik']."</td></tr>"; 
      }
    }
    else {
      $i = 0;
        while ($row = mysqli_fetch_array($result)) { 
          $i += 1;
          echo "<tr><td>".$i."</td><td>".$row['Login']."</td><td>".$row['Wiek']."</td> <td>".$row['Wynik']."</td></tr>"; 
        }
    }
    echo '</table>';
  
    echo '<form method="" action="gra.php">
    <button>Zagraj raz jeszcze!</button></form>';
    
    mysqli_close($con);
  ?>
</body>
</html>