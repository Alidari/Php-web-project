<?php
session_start();
require_once "config.php";
if (isset($_SESSION["email"])) {
    $form_email = $_SESSION["email"];

    $db_elements = mysqli_query($db, "SELECT * FROM `kullanicilar` WHERE `email` = '$form_email'");
    $db_elements = mysqli_fetch_assoc($db_elements);
}
if (isset($_GET["game_id"])) {
    $gameid = $_GET["game_id"];
    $_SESSION["gameid"] = $gameid;
} else {
    $gameid = $_SESSION["gameid"];
}


$db_game = mysqli_query($db, "SELECT * FROM `oyunlar` WHERE `id` = '" . $gameid . "'");
$db_game = mysqli_fetch_assoc($db_game);

if (isset($_POST["yorum"]) && $_POST["yorum"] != "") {
    $yorum = $_POST["yorum"];


    $existing_comment = mysqli_query($db, "SELECT * FROM `yorumlar` WHERE `oyun_id` = '" . $gameid . "' AND `yorum` = '" . $_POST["yorum"] . "'");
    $existing_comment = mysqli_fetch_assoc($existing_comment);

    if (!$existing_comment) {
        mysqli_query($db, "INSERT INTO `yorumlar` (`yorum`,`oyun_id`,`kullanici_id`) VALUES ('" . $yorum . "','" . $gameid . "','" . $db_elements["id"] . "')");
    }
}


$db_yorum = mysqli_query($db, "SELECT y.*, k.ad , k.soyad FROM `yorumlar` y INNER JOIN `kullanicilar` k ON y.kullanici_id = k.id WHERE y.`oyun_id` = '" . $gameid . "'");
$yorum_sayisi = mysqli_num_rows($db_yorum);
$db_yorum = mysqli_fetch_all($db_yorum);


$kullanicilar = mysqli_query($db, "SELECT `ad` FROM `kullanicilar`");
$kullanicilar = mysqli_fetch_all($kullanicilar);

$db_puan = mysqli_query($db, "SELECT `puan` FROM `kullanici_puan` WHERE `kullanici_id` = '" . $db_elements["id"] . "' AND `oyun_id` = '" . $gameid . "'");
$puanDurum = mysqli_num_rows($db_puan);


if (isset($_POST["rating"])) {

    $star = $_POST["rating"];




    if ($puanDurum == 0) {
        mysqli_query($db, "INSERT INTO `kullanici_puan` (`kullanici_id`,`oyun_id`,`puan`) VALUES ('" . $db_elements["id"] . "','" . $gameid . "','" . intval($star) . "')");
    } else {
        mysqli_query($db, "UPDATE `kullanici_puan` SET `puan` = '" . intval($star) . "'");
    }
    if (mysqli_errno($db)) {
        echo "Puanlama Yapilamadi";
    }
}

$db_puan = mysqli_query($db, "SELECT `puan` FROM `kullanici_puan` WHERE `kullanici_id` = '" . $db_elements["id"] . "' AND `oyun_id` = '" . $gameid . "'");
$puanDurum = mysqli_num_rows($db_puan);
$db_puan = mysqli_fetch_all($db_puan);







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
    <link rel="stylesheet" href="login.css">

    <style>

    </style>
</head>

<body>
    <div class="navbar">
        <nav>
            <div class="navbar-logo">
                <img src="rog.png" alt="rogLogo">
            </div>
            <ul class="nav">
                <li class="nav-item"> <a class="navlink" href="index.php">Ana Sayfa</a></li>
                <li class="nav-item"><a class="navlink" href="games.php">Oyunlar</a></li>

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
    <div class="container-sm">

        <div class="container-body">
            <div class="gamerewiev">
                <div class="gamereview-title white">
                    <h1><?php echo $db_game["isim"] . " Inceleme"; ?></h1>
                </div>
                <div class="gamerewiev-body">

                    <div style="margin:2em" class="gamereview-image"> <img src="<?php echo $db_game["resim"]; ?>" alt="">
                        <div class="gamerewiev-atribute">
                            <div class="tur white">
                                <div style="text-align: center" class="tur-title">Oyun Turu</div>
                                <div style="text-align: center;opacity:0.5" class="tur-body"><?php echo $db_game["tür"]; ?></div>
                            </div>
                            <div class="yayinci white">
                                <div style="text-align: center" class="yayici-title">Yapımcı - Yayıncı</div>
                                <div style="text-align: center;opacity:0.5" class="yayici-body"><?php echo $db_game["yapimci"]; ?></div>

                            </div>
                        </div>
                    </div>
                    <div style="width: 50%;" class="review1">
                        <div class="skor-general">
                            <div class="skors">
                                <div class="gamereview-metascore skor white" style="background-color:<?php
                                                                                                        if ($db_game["meta_skor"] <= 40) {
                                                                                                            echo "red";
                                                                                                        } elseif ($db_game["meta_skor"] > 40 && $db_game["meta_skor"] <= 74) {
                                                                                                            echo "rgb(255, 150, 0)";
                                                                                                        } else {
                                                                                                            echo "rgb(27, 150, 27)";
                                                                                                        }
                                                                                                        ?>"><?php echo $db_game["meta_skor"]; ?></div>
                                <div class="white">Meta Skor</div>
                            </div>
                            <div class="skors">
                                <div class="gamereview-usercore skor white" style="background-color:<?php
                                                                                                    if ($db_game["kul_skor"] <= 4) {
                                                                                                        echo "red";
                                                                                                    } elseif ($db_game["kul_skor"] > 4 && $db_game["kul_skor"] <= 7.4) {
                                                                                                        echo "rgb(255, 150, 0)";
                                                                                                    } else {
                                                                                                        echo "rgb(27, 150, 27)";
                                                                                                    }
                                                                                                    ?>"><?php echo $db_game["kul_skor"]; ?></div>
                                <div class="white">Kullanıcı Skoru</div>
                            </div>
                        </div>
                        <div class="aciklama">
                            <div class="aciklama-title white">Açıklama:</div>
                            <div style="opacity: 0.5;" class="white"><?php echo $db_game["Aciklama"]; ?></div>
                        </div>
                    </div>
                    <div class="puanlama">
                        <div class="puanlama-title white">PUANLA</div>
                        <div class="puanlama-body white">
                            <form action="game.php" method="post">

                                <div class="rating">
                                    <input type="radio" id="star5" name="rating" value="5">
                                    <label for="star5" title="5 yıldız">
                                        <i onclick="zipzip('star5i')" id="star5i" class="far fa-star"></i>
                                    </label>
                                    <input type="radio" id="star4" name="rating" value="4">
                                    <label for="star4" title="4 yıldız">
                                        <i onclick="zipzip('star4i')" id="star4i" class="far fa-star"></i>
                                    </label>
                                    <input type="radio" id="star3" name="rating" value="3">
                                    <label for="star3" title="3 yıldız">
                                        <i onclick="zipzip('star3i')" id="star3i" class="far fa-star"></i>
                                    </label>
                                    <input type="radio" id="star2" name="rating" value="2">
                                    <label for="star2" title="2 yıldız">
                                        <i onclick="zipzip('star2i')" id="star2i" class="far fa-star"></i>
                                    </label>
                                    <input type="radio" id="star1" name="rating" value="1">
                                    <label for="star1" title="1 yıldız">
                                        <i onclick="zipzip('star1i')" id="star1i" class="far fa-star"></i>
                                    </label>
                                </div>
                                <?php

                                if (isset($_SESSION["oturum"]) && $_SESSION["oturum"] == 1) {

                                ?>
                                    <button style="margin-top: 1em;" type="submit" class="btn btn-warning btn-sm">Puanla</button>
                                <?php
                                } else {
                                    echo "<span style = 'color:red;margin-top:3px'>puanlamak icin giris yapmalisiniz</span>";
                                }
                                ?>
                            </form>

                            <?php
                            if ($puanDurum != 0) {
                                echo "<div style = 'margin-top:1em'>Sizin Puanınız: " .  $db_puan[0][0] . "</div>";
                            }
                            ?>

                        </div>
                    </div>


                </div>

                <div class="comments">
                    <div class="title">Yorumlar</div>
                    <?php

                    for ($i = $yorum_sayisi - 1; $i >= 0; $i--) {



                    ?>
                        <div style="margin-bottom: 1em;" class="user-commnet">

                            <div class="pp"><?php echo $db_yorum[$i][4][0] . $db_yorum[$i][5][0]; ?></div>
                            <div class="commnet-text"><?php echo $db_yorum[$i][1]; ?></div>
                            <div style="margin-left:1em"><?php echo "Oyuna Verdiği Puan:"; ?></div>
                            <div class="pp"><?php echo  mysqli_fetch_all(mysqli_query($db,"SELECT `puan` FROM `kullanici_puan` WHERE `kullanici_id` = '" . $db_yorum[$i][3] . "' AND `oyun_id` = '" . $gameid . "'"))[0][0]; ?></div>
                        </div>
                    <?php

                    } ?>

                    <?php

                    if (isset($_SESSION["oturum"]) && $_SESSION["oturum"] == 1) {

                    ?>
                        <form action="game.php" method="POST">
                            <input style="width:100%;" type="text" placeholder="Yorum Yazınız" name="yorum" id="">
                            <div class="button"><button class="btn btn-light" type="submit">Gönder</button></div>
                        </form>

                    <?php
                    } else {
                        echo "Yorum yapmak için <a style='margin:2em' href = 'login.php'>Giriş Yapmalısınız</a>";
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <script>
        function zipzip(element) {

            for (var i = 1; i <= 5; i++) {
                var idname = "star" + i + "i";
                var starElement = document.getElementById(idname);
                starElement.classList.remove("fa-bounce");
            }

            for (var i = 1; i <= parseInt(element[4]); i++) {
                var idname = "star" + i + "i";
                var starElement = document.getElementById(idname);
                setTimeout(function(star) {
                    star.classList.add("fa-bounce");
                }, i * 100, starElement);
            }
        }

        function zipzip_sil(element) {
            var i = document.getElementById(element);
            i.classList.remove("fa-bounce");
        }
    </script>
</body>

</html>