
<?php

$dsn = "mysql:host=localhost;dbname=invoice;charset=utf8";
$pdo = new PDO($dsn,'root','');

$del = $pdo->exec("delete from invoices where id = '{$_GET['id']}'");
echo $del;

header("location:../index.php?do=invoiceDeposit");

?>