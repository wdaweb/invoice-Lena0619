   <?php
   //處理日期: 頁面初始值是當前年月份
   //今年
   date_default_timezone_set("Asia/Taipei");
   $year = date('Y');
   
   if(isset($_GET['year'])){
      $year = $_GET['year'];
   } else {
      $year = date('Y');
   }
   
   //當月 轉 當期
   $month = date('m');
   $period = ceil($month/2);
   
   if(isset($_GET['period'])){
      $period = $_GET['period'];
   } else {
      $period = ceil($month/2);
   }

   //上一期&下一期
   $nextPeriod = $period + 1;
   $nextYear = $year;
   if($nextPeriod>6){
      $nextPeriod = '1';
      $nextYear = $year + 1;
   };
   
   $prevPeriod = $period - 1;
   $prevYear = $year;
   if($prevPeriod<1){
      $prevPeriod = '6';
      $prevYear = $year - 1;
   };
   ?>



<!-- 連資料庫 -->
    <?php 
        $dsn = "mysql:host=localhost;dbname=invoice;charset=utf8";
        $pdo = new PDO($dsn,'root','');
      
      //   當期發票張數
        $sql = "select count(period) from `invoices` where `period`='$period' && LEFT(`date`,4) ='$year'";
        $con = $pdo->query($sql)->Fetch();
      //   當期發票消費總金額
        $sql = "select sum(payment) from `invoices` where `period`='$period' && LEFT(`date`,4) ='$year'";
        $pm = $pdo->query($sql)->Fetch();
      //   echo "<pre>";
      //   print_r($pm);
      //   echo "</pre>";


      $periodNum = [
         '1' => '1-2月',
         '2' => '3-4月',
         '3' => '5-6月',
         '4' => '7-8月',
         '5' => '9-10月',
         '6' => '11-12月'
      ];
     
    ?>


<div class="container pt-2">
    <h6 class="font-weight-bold">消費分析：</h6>
    <p><?=$periodNum[$period];?>消費支出<br><span class="text-warning font-weight-bold"><?=$pm[0];?></span> 元.</p>
    <p>累積消費<br><span class="text-warning font-weight-bold"><?=$con[0];?></span> 筆.</p>
    <!-- <p><a href="?do=invType">消費類別分析</a></p> -->

</div>