<?php

session_start();

$_SESSION["oturum"] = 0;
session_destroy();
header("Location: index.php");


?>