<?php
session_start();
require_once "config.php";
if (isset($_SESSION["email"])) {
    $form_email = $_SESSION["email"];

    $db_elements = mysqli_query($db, "SELECT * FROM `kullanicilar` WHERE `email` = '$form_email'");
    $db_elements = mysqli_fetch_assoc($db_elements);
}

$db_games = mysqli_query($db, "SELECT * FROM `oyunlar`");
$db_games = mysqli_fetch_all($db_games);


?>



<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROG</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="navbar">
        <nav>
            <div class="navbar-logo">
                <img src="rog.png" alt="rogLogo">
            </div>
            <ul class="nav">
                <li class="nav-item"> <a class="navlink" href="index.php">Ana Sayfa</a></li>
                <li class="nav-item"><a class="navlink" href="#">Oyunlar</a></li>

                <?php
                if (isset($_SESSION["oturum"]) && $_SESSION["oturum"] == 1) {
                ?>

                    <li class="nav-item">

                        <div class="oturum">
                            <div class="dropdown" style="position: relative;">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user" style="color: #ededed;"></i>
                                </a>

                                <ul class="dropdown-menu" style="left: auto; right: 0; transform-origin: top right;">
                                    <li style="text-align:center"> <?php echo $db_elements["ad"] . " " . $db_elements["soyad"]; ?> </li>
                                    <hr>
                                    <li style="text-align:center"><a class="dropdown-item" href="acount.php">Hesabım</a></li>
                                    <hr>
                                    <li style="text-align:center"><a class="dropdown-item" href="logout.php">Oturumu Kapat</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item"></li>



                <?php

                } else {
                ?>
                    <li class="nav-item"><a class="nav-login" href="login.php"><button type="button" class="btn btn-outline-warning btn-sm">Giris Yap</button></a></li>
                    <li class="nav-item"><a class="nav-login" href="signup.php"><button type="button" class="btn btn-warning">Kayıt Ol</button></a></li>
                <?php
                } ?>
            </ul>
        </nav>
    </div>
                
    <div class="container-sm games-php">
                <?php
                
                for ($i=count($db_games)-1; $i >=0 ; $i--) { 
                    
                ?>
                <a href="game.php?game_id=<?php echo $db_games[$i][0]; ?>">
                <div class="game">
                    <img src="<?php echo $db_games[$i][2] ?>" alt="oyunResim">
                </div>
                </a>
                    <?php
                    
                }
                    ?>






    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


</body>

</html>