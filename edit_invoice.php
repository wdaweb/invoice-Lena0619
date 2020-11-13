編輯發票
$_GET['id']
<?php

$sql = "select * from invoices where id='{$_GET['id']}'";
$inv = $pdo->query($sql)->fetch();
echo "<pre>";
print_r($inv);
echo "</pre>";
?>