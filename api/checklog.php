<?php

$dsn = "mysql:host=localhost;dbname=invoice;charset=utf8";
$pdo = new PDO($dsn,'root','');

$acc = $_POST['acc'];
$pw = $_POST['pw'];

$sql = "select * from `login` where `acc`='$acc' && `pw`='$pw'";
$admin = $pdo->query($sql)->fetch();
echo $sql."</br>";
echo "<pre>";
print_r($admin);
echo "</pre>";

if(!empty($admin)){
    header("location:../?do=admin&meg=登入成功!");
} else {
    header("location:../?do=adminLogin&meg=帳密錯誤!");
}



?>