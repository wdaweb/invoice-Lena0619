<?php

$dsn = "mysql:host=localhost;dbname=invoice;charset=utf8";
$pdo =new PDO($dsn,'root','');

$del = $pdo->exec("delete from `award_numbers` where year = '{$_POST['year']}' && period ='{$_POST['period']}'");

header("location:../index.php?do=enterAwards");
?>