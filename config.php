<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "rog";

$db_host_on = "sql308.epizy.com";
$db_user_on = "epiz_34240392";
$db_pass_on = "h1yjFkUvDQef";
$db_name_on = "epiz_34240392_rog";


// $db = mysqli_connect($db_host_on,$db_user_on,$db_pass_on,$db_name_on);
$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);



if(mysqli_connect_errno()){
    echo "baglanti kurulamadi";
    exit();
}

 

?>