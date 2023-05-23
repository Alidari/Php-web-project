<?php
session_start();
require_once "config.php";


if (isset($_POST["hesapsil"])) {
    if ($_POST["hesapsil"] == "EVET") {
        $_SESSION["oturum"] = 0;
        mysqli_query($db, "DELETE FROM `kullanicilar` WHERE `email` = '".$_SESSION["email"]."'");

        header("Location: index.php");
        exit;
       
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["ad"] != "" && $_POST["soyad"] != "" && $_POST["email"] != "") {
        $form_ad = $_POST["ad"];
        $form_soyad = $_POST["soyad"];
        $form_email = $_POST["email"];

        // mysqli_query($db, "UPDATE `kullanicilar` SET `ad` = '$form_ad', `soyad` = '$form_soyad', `email` = '$form_email' WHERE `email` =`".$_SESSION["email"]."`");
        $db_new = mysqli_query($db, "UPDATE `kullanicilar` SET `ad` = '$form_ad', `soyad` = '$form_soyad', `email` = '$form_email' WHERE `email` = '" . $_SESSION["email"] . "'");
        $db_new = mysqli_fetch_assoc($db_new);
        $_SESSION["email"] = $db_new["email"];
        if ($_POST["password"] != "") {
            $form_password = $_POST["password"];
            $password_hash = hash("sha256", $form_password);
            mysqli_query($db, "UPDATE `kullanicilar` SET `sifre` = '$password_hash'");
        }
    } else {
        echo "Ad, Soyad veya Email alanı boş bırakılamaz";
    }
}

if (isset($_SESSION["email"])) {
    $form_email = $_SESSION["email"];
    $db_elements = mysqli_query($db, "SELECT * FROM `kullanicilar` WHERE `email` = '$form_email'");
    $db_elements = mysqli_fetch_assoc($db_elements);
}


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
    <div class="acount-main">

        <div class="back" style="background-color:#8087971d;"> <a href="index.php"><i class="fa-solid fa-backward" style="color:white;"></i></a></div>

        <div class="sections">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action list-group-item-dark active">Hesap
                    Bilgileri</a>
                <a onclick="hesapsilsoru()" href="#" class="list-group-item list-group-item-action list-group-item-danger">Hesabı Sil</a>
            </div>
        </div>
        <div id="info" class="info">
            <div class="personel-info">
                <div id="hesap-sil" class="hesap-sil">
                    <div class="hesapsil-text">Hesabınızı silmek istedigine eminseniz aşağıdaki kısma `EVET` yazınız.</div>
                    <div class="hesapsil-buttons">
                        <form action="acount.php" method="post">

                            <input type="text" placeholder="EVET" name="hesapsil">
                            <button onclick="hesapsilme()" type="submit">KABUL</button>
                        </form>
                    </div>
                </div>
                <form id="form-info" action="acount.php" method="POST">
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">Ad</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Ad" value="<?php echo $db_elements["ad"] ?>" name="ad">
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">Soyad</label>
                        <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="soyad" value="<?php echo $db_elements["soyad"] ?>" name="soyad">
                    </div>
                    <div class="mb-2">
                        <br>
                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleFormControlInput3" placeholder="email" value="<?php echo $db_elements["email"] ?>" name="email">
                    </div>
                    <div class="mb-2">
                        <br>
                        <label for="exampleFormControlInput1" class="form-label">Yeni Sifre</label>
                        <div class="input-group">
                            <input type="password" style="width: 9em;" class="form-control disabled" id="exampleFormControlInput4" placeholder="password" name="password">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fa-solid fa-eye"></i></button>
                        </div>
                    </div>

                    <div class="mb-2">
                        <br>
                        <button style="width: 15em;" type="submit" class="btn btn-success">Güncelle</button>
                    </div>
                </form>



            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#togglePassword').click(function() {
                var passwordInput = $('#exampleFormControlInput4');
                var passwordToggle = $(this);

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    passwordToggle.html('<i class="fa-solid fa-eye-slash"></i>');
                } else {
                    passwordInput.attr('type', 'password');
                    passwordToggle.html('<i class="fa-solid fa-eye"></i>');
                }
            });
        });
    </script>

    <script>
        function hesapsilsoru() {
            var bilgiler = document.getElementById("form-info");
            bilgiler.style.display = "none";
            bilgiler = document.getElementById("hesap-sil");
            bilgiler.style.display = "flex";
        }


        function hesapsilme() {
            var bilgiler = document.getElementById("hesap-sil");
            bilgiler.style.display = "none";
            bilgiler = document.getElementById("form-info");
            bilgiler.style.display = "flex";
        }
    </script>

</body>

</html>