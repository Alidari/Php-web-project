<?php


require_once "config.php";

$epostahata = 0;
$passwordFlag = 1;
if (isset($_POST["ad"]) && isset($_POST["soyad"]) && isset($_POST["password"]) && isset($_POST["eposta"])) {
    $flag = "degergonderilmis";
    if ($_POST["ad"] == "" || $_POST["soyad"] == "" || $_POST["password"] == "" || $_POST["eposta"] == "") {
        $flag = "degerbos";
    } else {
        $ad = $_POST["ad"];
        $soyad = $_POST["soyad"];
        $password = $_POST["password"];
        $eposta = $_POST["eposta"];
        $flag = "degerdolu";

        if (strlen($password) < 6 || strlen($password) > 16) {
            $passwordFlag = 0;
        } else {
            $passwordFlag = 1;

            $form_password_hash = hash("sha256", $password);

            $eposta_kontrol = mysqli_query($db, "SELECT * FROM `kullanicilar` WHERE `email` = '" . $eposta . "'");


            if (mysqli_num_rows($eposta_kontrol) == 0) {
                $sql = mysqli_query($db, "INSERT INTO `kullanicilar` (`ad`,`soyad`,`email`,`sifre`) VALUES ('" . $ad . "','" . $soyad . "','" . $eposta . "','" . $form_password_hash . "')");


                if (mysqli_errno($db) != 0) {
                    echo "Bir hata meydana geldi";
                    exit;
                } else {

?>

                    <!DOCTYPE html>
                    <html lang="en">

                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
                        <link rel="stylesheet" href="login.css">
                        <title>Document</title>
                    </head>

                    <body>
                        <div class="container">
                            <div class="sucsess alert alert-success" role="alert">
                                <p>Kaydınız başarıyla oluşturulmuştur</p>
                                <hr>
                                <p>Giriş yapmak için <a href="login.php">tıklayınız</a> </p>
                            </div>
                        </div>


                    </body>

                    </html>






    <?php
                }
            }
            else{
                echo "<div style = 'color:red;margin-top:3em'>böyle bir eposta mevcuttur</div>";
                $epostahata = 1;
            }
        }
    }
} else {
    $flag = "degergonderilmemis";
}
if ($flag == "degergonderilmemis" || $flag == "degerbos" || $passwordFlag == 0 || $epostahata == 1) {

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="login.css">


        <title>ROG</title>
    </head>

    <body>
        <div class="container">
            <div class="back" style="background-color:#8087971d;"> <a href="index.php"><i class="fa-solid fa-backward" style="color:white;"></i></a></div>

            <div class="logo">
                <img src="rog.png" alt="" width="100vh" style="border-radius: 10px; margin-bottom:15px">
            </div>
            <div class="login">
                <form action="signup.php" method="POST">
                    <div class="name-surname">
                        <div class="input form-group">
                            <div class="icon"><i class="fa-solid fa-user"></i></div>
                            <input type="text" class="form-control" id="floatingInput" placeholder="Ad" name="ad"> <br>
                        </div>
                        <div class="input form-group">
                            <div class="icon"><i class="fa-solid fa-user"></i></div>
                            <input type="text" class="form-control" id="floatingInput" placeholder="Soyad" name="soyad"> <br>
                        </div>
                    </div>
                    <div class="input form-group">
                        <div class="icon"><i class="fa-solid fa-envelope"></i></div>
                        <input type="email" class="form-control" id="floatingInput" placeholder="Eposta" name="eposta"> <br>
                    </div>
                    <div class="input form-group">
                        <div class="icon"><i class="fa-solid fa-lock"></i> </div>
                        <input type="password" class="form-control" placeholder="Sifre" name="password"> <br>
                    </div>
                    <div class="text warning">
                        <p id="passwordWarn">*Şifre 6 ile 16 karakter uzunluğu arasında olmalı</p>
                    </div>
                    <div class="text warning" id="control-warning">
                        <p style="color:#CC1010">*Zorunlu alanları doldurunuz</p>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-danger" type="submit">Giriş Yap</button>
                    </div>
                    <div class="text">
                        <p>Zaten bir hesabın var mı? <a href="login.html">Giriş Yap</a></p>
                    </div>
                </form>
            </div>
        </div>

        <script>
            <?php

            if ($flag ==  "degerbos") {
            ?>
                var text = document.getElementById("control-warning");
                text.style.display = "block";
            <?php
            }
            ?>
            <?php
            if ($flag ==  "degergonderilmemis" || $flag == "degerdolu") {
            ?>
                var text = document.getElementById("control-warning");
                text.style.display = "none";
            <?php
            }
            ?>
            <?php

            if ($passwordFlag ==  0) {
            ?>
                var element = document.getElementById("passwordWarn");
                element.style.color = "red";
            <?php
            }
            ?>
        </script>
    </body>

    </html>

<?php

}

?>