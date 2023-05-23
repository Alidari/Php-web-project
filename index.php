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

$top5 = mysqli_query($db, "SELECT * FROM `oyunlar` ORDER BY `meta_skor` DESC LIMIT 5");
$top5 = mysqli_fetch_all($top5);


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
                <li class="nav-item"> <a class="navlink" href="#">Ana Sayfa</a></li>
                <li class="nav-item"><a class="navlink" href="games.php">Oyunlar</a></li>
                <li class="nav-item"><a class="navlink" href="games.php"><i class="fa-brands fa-github"></i></a></li>
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
    
    <div class="container">

        <div class="container-body">
            <div class="slider">
                <h2 class="baslik" style="color:white">SON ÇIKANLAR</h2>

                <div id="carouselExampleIndicators" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img style="opacity: 0.5;" src="<?php echo $db_games[count($db_games)-1][8]; ?>" class="d-block w-100" alt="oyunResim">
                        </div>
                        <div class="carousel-item">
                            <img style="opacity: 0.5;" src="<?php echo $db_games[count($db_games)-2][8]; ?>" class="d-block w-100" alt="oyunResim">
                        </div>
                        <div class="carousel-item">
                            <img style="opacity: 0.5;" src="<?php echo $db_games[count($db_games)-3][8]; ?>" class="d-block w-100" alt="oyunResim">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="game-review">
                <h2 class="baslik" style="color:white">OYUN INCELEMELERI</h2>
            </div>
            <div class="general-games">
                <div class="games">
                    <?php
                    for ($i = count($db_games)-1; $i >=0 ; $i--) {

                    ?>
                        <a href="game.php?game_id=<?php echo $db_games[$i][0]; ?>">
                            <div class="game-body">
                                <div class="game-img"><img src="<?php echo $db_games[$i][2]; ?>" style="max-width:15em;" alt="">
                                    <div class="meta-score" style="background-color:<?php
                                                                                    if ($db_games[$i][5] <= 40) {
                                                                                        echo "red";
                                                                                    } elseif ($db_games[$i][5] > 40 && $db_games[$i][5] <= 74) {
                                                                                        echo "rgb(255, 150, 0)";
                                                                                    } else {
                                                                                        echo "rgb(27, 150, 27)";
                                                                                    }
                                                                                    ?>"><?php echo $db_games[$i][5]; ?></div>
                                </div>
                                <div class="game-detail">
                                    <div id= "game-title" class="game-title"><?php echo $db_games[$i][1]; ?> incelemesi</div>
                                    <div class="game-detail-body"> Yapımcı - Yayıncı: <?php echo $db_games[$i][3]; ?> </div>
                                    <div class="game-detail-body">Tür: <?php echo $db_games[$i][6]; ?></div>
                                    <div class="game-detail-body"> <?php

                                                                    if (strlen($db_games[$i][7]) > 100) {
                                                                        $game_desc = str_word_count($db_games[$i][7], 1, "ğĞüÜşŞıİöÖçÇ");
                                                                        $game_desc = implode(' ', array_slice($game_desc, 0, 30));
                                                                        $game_desc = $game_desc . "<a href= '#'> Devamını Okuyun...</a>";
                                                                        echo $game_desc;
                                                                    } else {
                                                                        echo $db_games[$i][7];
                                                                    }
                                                                    ?></div>
                                </div>

                            </div>
                        </a>
                        <hr style="color:white;width:90%;margin:1em auto">
                    <?php
                    }

                    ?>
                </div>
                <div class="top-5">

                    <div style="margin-left: 0;" class="game-detail">
                        <div style="text-align:center"> TOP 3 GAMES </div>
                        <hr>
                        <?php

                        for ($i = 0; $i < 3; $i++) {
                        ?> <div style="margin:0.75em" class="top">
                                <div style="font-size: 2rem;text-align:center;" class="game-title"><?php echo "#" . ($i + 1); ?> </div>
                                <div class="game-img"><img style="width:8em" src="<?php echo $top5[$i][2] ?>" alt=""></div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>

                </div>
            </div>


    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>



    </script>

</body>

</html>