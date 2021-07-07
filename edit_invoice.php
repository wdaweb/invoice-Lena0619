<p>編輯發票資料:</p>

<?php

$dsn = "mysql:host=localhost;dbname=invoice;charset=utf8";
$pdo = new PDO($dsn,'root','');
$sql = "select * from invoices where id='{$_GET['id']}'";
$invo = $pdo->query($sql)->fetch();

?>
<div class="container">
<form action="api/update_invoice.php" method="post">
    <input type="hidden" name="id" value="<?=$invo['id'];?>">
    <div>發票號碼:
        <input type="text" name="code" style="width:40px" value="<?=$invo['code'];?>">
        <input type="text" name="number" value="<?=$invo['number']?>">
    </div>
    <div>消費日期:
        <input type="date" name="date" value="<?=$invo['date'];?>">
    </div>
    <div>消費金額:
        <input type="text" name="payment" value="<?=$invo['payment'];?>">
    </div>
        <input type="submit" class="btn bg-primary my-2 btn-small" value="修改"> 
        <input type="reset"class="btn bg-warning my-2 btn-small" value="重置"> 
</form>
</div>

