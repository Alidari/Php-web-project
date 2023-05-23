<?php
session_start();
require_once "config.php";


$flag = 0;
$num = "";
if (isset($_POST["email"]) && isset($_POST["password"])) {
    $flag = 1;
    $form_email = $_POST["email"];
    $form_password = $_POST["password"];

    $form_password_hash = hash("sha256", $form_password);

    $db_elements = mysqli_query($db, "SELECT * FROM `kullanicilar` WHERE `email` = '$form_email' AND `sifre` = '$form_password_hash'");
    $num = mysqli_num_rows($db_elements);
    if ($num == 1) {
        $_SESSION["oturum"] = 1;
        $_SESSION["email"] = $form_email;
        header("Location: index.php");
    }
}
if ($flag == 0 || $num == 0) {
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
                <img src="rog.png" alt="" width="100vh" style="border-radius: 10px;">
            </div>
            <div class="login">
                <form action="login.php" method="POST">
                    <div class="input form-group">
                        <div class="icon"><i class="fa-solid fa-user"></i></div>
                        <input type="email" class="form-control" id="floatingInput" placeholder="Eposta" name="email"> <br>
                    </div>
                    <div class="input form-group loginPassword">
                        <div class="icon"><i class="fa-solid fa-lock"></i> </div>
                        <input type="password" class="form-control" placeholder="Sifre" name="password"> <br>
                    </div>
                    <div id="alert" class="alert alert-danger" role="alert">
                        Bilgileriniz Hatalı!
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-danger" type="submit">Giriş Yap</button>
                    </div>
                </form>
                <div class="text">
                        <p>Kayıtlı bir hesabın yok mu?<a href="signup.php">Kayıt ol</a></p>
                    </div>
            </div>
        </div>
        <script>
            var el = document.getElementById("alert");
            el.style.display = "none";
            <?php
            if ($num == 0) {
            ?>
                el.style.display = "flex";
            <?php

            }

            ?>
        </script>
    </body>

    </html>
<?php

}



?>