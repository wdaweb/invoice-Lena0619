<?php
//處理日期: 頁面初始值是當前年月份
//今年
date_default_timezone_set("Asia/Taipei");
$year = date('Y');

if (isset($_GET['year'])) {
   $year = $_GET['year'];
} else {
   $year = date('Y');
}

//當月 轉 當期
$month = date('m');
$period = ceil($month / 2);

if (isset($_GET['period'])) {
   $period = $_GET['period'];
} else {
   $period = ceil($month / 2);
}

//上一期&下一期
$nextPeriod = $period + 1;
$nextYear = $year;
if ($nextPeriod > 6) {
   $nextPeriod = '1';
   $nextYear = $year + 1;
};

$prevPeriod = $period - 1;
$prevYear = $year;
if ($prevPeriod < 1) {
   $prevPeriod = '6';
   $prevYear = $year - 1;
};

//期別 轉 月份
$month2 = [
   '1' => '1 - 2',
   '2' => '3 - 4',
   '3' => '5 - 6',
   '4' => '7 - 8',
   '5' => '9 - 10',
   '6' => '11 - 12'
];
$mon2 = $month2[$period];

//西元年 轉 民國年
$taiwanY = $year - 1911;

//對獎倒數
$endmon = [3, 5, 7, 9, 11, 1];

if ($endmon[$period - 1] == 1) {
   $yy = $year + 1;
} else {
   $yy = $year;
};

$now = time();
$end = mktime(13, 30, 0, $endmon[$period - 1], 26, $yy);
// $end = date('Y-m-d',mktime(13,30,0,$endmon[$period-1],25,$yy));
$time = $end - $now;
$show = intval($time / 60 / 60 / 24);
?>


<div class="container">

   <!-- 選年月分 -->
   <div class="row align-items-center" style="background:lightgray;">
      <div class="col-2"><a href="?do=invoiceDeposit&year=<?= $prevYear ?>&period=<?= $prevPeriod ?>"><i class="fas fa-angle-left"></i></a></div>
      <div class="col-8">
         <p class="d-flex justify-content-center mb-0"><?= $taiwanY ?> 年 <?= $mon2 ?>月</p>
      </div>
      <div class="col-2"><a href="?do=invoiceDeposit&year=<?= $nextYear ?>&period=<?= $nextPeriod ?>"><i class="fas fa-angle-right float-right"></i></a></div>
   </div>

   <!-- 連資料庫 -->
   <?php
   $dsn = "mysql:host=localhost;dbname=invoice;charset=utf8";
   $pdo = new PDO($dsn, 'root', '');
   //   當期所有的發票
   $sql = "select * from `invoices` where `period`='$period' && LEFT(`date`,4) ='$year' order by `date` desc";
   $invoices = $pdo->query($sql)->FetchAll();
   //   當期月份
   $sql = "select * from `invoices` where `period`='$period' && LEFT(`date`,4) ='$year' GROUP BY SUBSTRING(`date`,6,2)";
   $montypes = $pdo->query($sql)->FetchAll();
   //   當期發票張數
   $sql = "select count(period) from `invoices` where `period`='$period' && LEFT(`date`,4) ='$year'";
   $con = $pdo->query($sql)->Fetch();
   //   當期發票消費總金額
   $sql = "select sum(payment) from `invoices` where `period`='$period' && LEFT(`date`,4) ='$year'";
   $pm = $pdo->query($sql)->Fetch();
   //   echo "<pre>";
   //   print_r($invoices);
   //   echo "</pre>";

   //撈出ID
   foreach ($invoices as $i) {
      $id = $i['id'];
      // echo $id."<br>";
   }
   ?>

   <!-- 統計 -->
   <div class="row text-center m-2">
      <div class="col-4">發票張數<br><?= $con[0]; ?></div>
      <div class="col-4" style="border-left:1px solid gray; border-right:1px solid gray;">消費總金額<br> $ <?= $pm[0]; ?></div>
      <div class="col-4">
         <?php
         if ($show <= 0) {
            echo "<button class='btn btn-info'><a href='?do=chekAwdAll&year=$year&period=$period' class='text-decoration-none text-light'>開始對獎!</a></button>";
         } else {
            echo "開獎倒數<br>" . $show . "天";
         };
         ?>
      </div>
   </div>

   <form action="chekAwdAll.php" method="post">
      <!-- 發票 -->
      <?php
      foreach ($montypes as $mon) {
         $m = substr($mon['date'], 5, 2); //月份
         $floM = ($period * 2) - 1;         //當期的floor月份

         if ($m == $floM) {               //判斷月份比較前面先印出來  
      ?>
            <div class="row pl-2" style="background:lightgray;"><?= $m; ?> 月</div>
            <?php
            foreach ($invoices as $inv) {
               $d = substr($inv['date'], -2, 2);   //日期
               $wkday = date('w', strtotime($inv['date']));    //星期
               $wklist = ['週日', '週一', '週二', '週三', '週四', '週五', '週六'];  //中文星期
               $mm = substr($inv['date'], 5, 2);     //月份
               $floMM = ($period * 2) - 1;     //當期的floor月份
               $ceiMM = ($period * 2);    //當期的ceil月份

               if ($mm == $floMM) {    //月份比較前面先印出來
            ?>
                  <div class="c2 row text-center align-items-center p-1 border-bottom ">
                     <div class="col-3"><?= $d ?><br><?= $wklist[$wkday]; ?></div>
                     <div class="col-5">
                        <?= $inv['code'] . "-" . $inv['number']; ?>
                        <?php
                        // if(isset($_GET['meg'])){
                        //    echo $_GET['meg'];
                        // }
                        ?>
                     </div>
                     <div class="col-2">$ <?= $inv['payment']; ?></div>
                     <div class="col-2" style="display:none">
                        <!-- ...... -->
                        <button class="btn btn-sm btn-primary">
                           <a class="text-light" href="?do=edit_invoice&id=<?= $inv['id']; ?>">編輯</a>
                        </button>
                        <button class="btn btn-sm btn-danger">
                           <a class="text-light" href="?do=del_invoice&id=<?= $inv['id']; ?>">刪除</a>
                        </button>
                        <!-- <button class="btn btn-sm btn-success">
               <a class="text-light" href="?do=award&id=<?= $inv['id']; ?>">對獎</a>
         </button> -->
                     </div>
                  </div>
            <?php
               }
            }
         } else {
            ?>
            <div class="row pl-2" style="background:lightgray;"><?= $m; ?> 月</div>
      <?php
         }
      }
      ?>
      <?php
      foreach ($invoices as $inv) {
         $d = substr($inv['date'], -2, 2);  //日期
         $wkday = date('w', strtotime($inv['date']));     //星期
         $wklist = ['週日', '週一', '週二', '週三', '週四', '週五', '週六'];   //中文星期
         $mm = substr($inv['date'], 5, 2);  //月份
         $floMM = ($period * 2) - 1;   //當期的floor月份
         $ceiMM = ($period * 2);   //當期的ceil月份

         if ($mm == $ceiMM) {    // 月份比較後面最後印出來
      ?>
            <div class=" b2 row text-center align-items-center p-1 border-bottom">
               <div class="col-3"><?= $d ?><br><?= $wklist[$wkday]; ?></div>
               <div class="col-5"><?= $inv['code'] . "-" . $inv['number']; ?></div>
               <div class="col-2">$ <?= $inv['payment']; ?></div>
               <div class="d-none">$ <?= $inv['id']; ?></div>
               <div class="col-2" style="display:none">
                  <!-- .. -->
                  <button class="btn btn-sm btn-primary">
                     <a class="text-light" href="?do=edit_invoice&id=<?= $inv['id']; ?>">編輯</a>
                  </button>
                  <button class="btn btn-sm btn-danger">
                     <a class="text-light" href="?do=del_invoice&id=<?= $inv['id']; ?>">刪除</a>
                  </button>
                  <!-- <button class="btn btn-sm btn-success">
               <a class="text-light" href="?do=award&id=<?= $inv['id']; ?>">對獎</a>
         </button> -->
               </div>
            </div>
      <?php
         }
      }

      ?>
   </form>


   <!-- 新增發票 -->
   <div class="btnHov">
      <i class="fas fa-plus" style="position:relative;top:9px;left:17px;">
         <ul class="hid hid1" id="update">
            <li><a id="a1" href="#">更新載具發票</a></li><!-- 00 -->
         </ul>
         <ul class="hid hid2">
            <li><a href="?do=enterAwdInfos">手動輸入</a></li>
         </ul>
         <ul class="hid hid3">
            <li><a href="#">掃描QRcode</a></li>
         </ul>
      </i>
   </div>

   <script>
      let a1 = document.getElementById('a1');
      let c2 = document.getElementsByClassName('c2');
      let b2 = document.getElementsByClassName('b2');
      a1.show = true;
      a1.onclick = function() {
         a1.show = !a1.show;
         for (let i = 0; i < c2.length; i++) {
            let c1 = c2[i].getElementsByTagName('div')[3];
            if (a1.show == true) {
               c1.style.display = 'none';
            } else {
               c1.style.display = 'block';
            }
         }
         for (let i = 0; i < b2.length; i++) {
            let b1 = b2[i].getElementsByTagName('div')[4];
            if (a1.show == true) {
               b1.style.display = 'none';
            } else {
               b1.style.display = 'block';

            }
         }
      }
   </script>