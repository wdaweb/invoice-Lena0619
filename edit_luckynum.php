//編輯兌獎號碼
<?php

$dsn = "mysql:host:localhost;dbname=invoice;charset=utf8";
$pdo = new PDO($dsn,'root','');

//撈出所有的獎號
$awdNums = $pdo->query("select * from `award_numbers`")->fetchAll();

?>

<div class='row justify-content-around' style="list-style-type:none;padding:0">
   <li><a href="?do=edit_luckynum&pd=2020-1">1,2月</a></li>
   <li><a href="?do=edit_luckynum&pd=2020-2">3,4月</a></li>
   <li><a href="?do=edit_luckynum&pd=2020-3">5,6月</a></li>
   <li><a href="?do=edit_luckynum&pd=2020-4">7,8月</a></li>
   <li><a href="?do=edit_luckynum&pd=2020-5">9,10月</a></li>
   <li><a href="?do=edit_luckynum&pd=2020-6 ">11,12月</a></li>
</div>