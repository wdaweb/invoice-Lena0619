<?php
//把user輸入的發票資料新增到資料庫&發票存摺

$dsn="mysql:host=localhost;dbname=invoice;charset=utf8";
$pdo=new PDO($dsn,'root','');

//把表單參數傳過來
$date = $_POST['date'];
$period = $_POST['period'];
$code = $_POST['code'];
$number = $_POST['number'];
$payment = $_POST['payment'];
$paytype = $_POST['paytype'];


//參數傳入資料庫
$sql="insert into `invoices`(`code`,`number`,`period`,`payment`,`paytype`,`date`) values ('$code','$number','$period','$payment','$paytype','$date')";
$pdo->exec($sql);
//判斷輸入錯誤導回原輸入頁面(未完待續...)
header("location:../index.php?do=invoiceDeposit");

?>