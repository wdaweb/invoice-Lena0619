
<?php
$dsn = "mysql:host=localhost;dbname=invoice;charset=utf8";
$pdo = new PDO($dsn, 'root', '');

$grpPeriod = $pdo->query("select `period` from `award_numbers`group by `period`")->fetchAll();  //抓出所有period
$grpYear = $pdo->query("select `year` from `award_numbers`group by `year`")->fetchAll(); //抓出所有year

?>

<p class="mt-3">請選擇要刪除的年份及期別：</p>
<form action="api/del_luckyAward.php" method="post">
<select name="year">
  <?php
  foreach ($grpYear as $y) {
  ?>
    <option value="<?= $y[0]; ?>"><?= $y[0]; ?></option>
  <?php
  }
  ?>
</select>

<select name="period"  onchange="">
  <?php
  foreach ($grpPeriod as $p) {
    switch ($p[0]) {
      case 1:
        $period = "1-2月";
        break;
      case 2:
        $period = "3-4月";
        break;
      case 3:
        $period = "5-6月";
        break;
      case 4:
        $period = "7-8月";
        break;
      case 5:
        $period = "9-10月";
        break;
      case 6:
        $period = "11-12月";
        break;
    }
  ?>
    <option value="<?=$p[0];?>"><?= $period; ?></option>
  <?php
  }
  ?>
</select>

<input type="submit" value="確認">
</form>