<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gra</title>
  <style>
    body {
      background-color: darkSlateGray;
      margin-right: auto;
      margin-left: auto;
      text-align: center;
      color: white;
    }
    h1 {
      color: white;
      text-align: center;
    }
    input {
      margin: 10px;
      padding-left: 5px;
      padding-right: 5px;
      height: 30px;
      width: 140px;
      border: 2px solid #73AD21;
      background-color: white;
    }
    input:hover {
            border: 2px solid #40ff00;
    }
    input[type="submit"]:hover {
    color: white;
    background-color: #669999;
    cursor: pointer;
    }
    hr {
      margin-top: 10px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <h1>Gra - Zgadnij liczbę od 1 do 100</h1>
  <img src="https://images-na.ssl-images-amazon.com/images/I/61BRwWBPKfL.png" height="300px" width="300px" alt="Tu powinno być fajne zdjęcie">
  <hr>
  
  <h3>Pomyślałem liczbę od 1 do 100<br>Zgadniesz jaką?</h3>
  <form method="post" action="gra.php">
    <h4>Liczba: <input type="number" min=1 max=100 name="number"></h4>
      <input type="submit" style="padding: 5px; border-radius: 20px; 
        cursor: pointer; " value="Sprawdź">
  </form>
  <br>
  <?php 
    if(is_numeric($_POST['number']) && isset($_POST['number'])) {
      $num = $_POST['number'];
        
      if(isset($_SESSION['attempts'])) {
        $_SESSION['attempts'] += 1;
      }
      else {
        $_SESSION['attempts'] = 1;
      }
      if(!isset($_SESSION['random'])) {
        $_SESSION['random'] = rand(1, 100);
      }

      // echo 'Attempts: '.$_SESSION['attempts'].'<br>';
      // echo 'Random: '.$_SESSION['random'].'<br>';

      if($num == $_SESSION['random']) {
        echo 'Brawo, zgadles za '.$_SESSION['attempts'].' razem!<br><br>';
        
        echo 'Zarejestruj się w bazie z wynikami<br>';
        
        echo '<form method="post" action="tabela.php">
          Nazwa: <input type="text" placeholder="Nazwa uzytkownika" name="name" required><br>   
          Wiek: <input type="number" placeholder="33" min="1" max="100" name="age" required><br>
          Prób: <input type="number" name="attempts" readonly value="'.$_SESSION['attempts'].'"><br>
          <input type="submit">
          </form>';  
          session_destroy();
        }
      elseif($num > $_SESSION['random']) {
        echo 'Twoja liczba jest za duza';
      }
      else {
        echo 'Twoja liczba jest za mala';
      } 
    }
  ?>
</body>
</html>