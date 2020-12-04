<?php

$dsn = "mysql:host=localhost;dbname=invoice;charset=utf8";
$pdo = new PDO($dsn,'root','');

$update = $pdo->exec("update invoices set `code`='{$_POST['code']}',`number`='{$_POST['number']}',`date`='{$_POST['date']}',`payment`='{$_POST['payment']}' where `id`='{$_POST['id']}'");
// echo "<pre>";
// print_r($update);
// echo "</pre>";


header("location:../index.php?do=invoiceDeposit");

?>
