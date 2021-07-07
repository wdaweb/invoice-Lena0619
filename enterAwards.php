<?php

$dsn = "mysql:host=localhost;dbname=invoice;charset=utf8";
$pdo = new PDO($dsn, 'root', '');

if (isset($_GET['pd'])) {
  $year = explode("-", $_GET['pd'])[0];
  $period = explode("-", $_GET['pd'])[1];
} else {
  $get_news = $pdo->query("SELECT * FROM `award_numbers` order by year desc ,period desc limit 1")->fetch();
  $year = $get_news['year'];
  $period = $get_news['period'];
}
/* echo "year=".$year;
echo "<br>";
echo "period=".$period; */
$awards = $pdo->query("select * from award_numbers where year='$year' && period='$period'")->fetchAll();
$special = "";
$grand = "";
$first = [];
$six = [];

foreach ($awards as $aw) {
  switch ($aw['type']) {
    case 1:
      $special = $aw['number'];
      break;
    case 2:
      $grand = $aw['number'];
      break;
    case 3:
      $first[] = $aw['number'];
      break;
    case 4:
      $six[] = $aw['number'];
      break;
  }
}
?>

<div class="accordion" id="accordionExample">

  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left text-dark" data-toggle="collapse" data-target="#collapseOne">
          手動對獎
        </button>
      </h2>
    </div>
    <div id="collapseOne" class="collapse show">
      <div class="card-body">

        <form action="?do=checkAwards" method="post">
          <h6 class="border-bottom border-dark d-inline-block">快速對獎</h6><br>
          <p class="text-black-50 my-1">請選擇年份及期別：</p>
          <select name="year">
            <option value="2020">2020年</option>
            <option value="2019">2019年</option>
          </select>
          <select name="period">
            <option value="1">01-02月</option>
            <option value="2">03-04月</option>
            <option value="3">05-06月</option>
            <option value="4">07-08月</option>
            <option value="5">09-10月</option>
            <option value="6">11-12月</option>
          </select>
          <p class="text-black-50 my-1">請輸入發票末三碼：</p>
          <input type="number" class="d-block" name="last3num">
          <input type="submit" value="送出" class="btn btn-primary btn-sm mt-2">
          <input type="reset" value="重置" class="btn btn-success btn-sm mt-2">
          <div class="text-danger mt-1"><?php if (isset($_GET['meg'])) {
                                          echo $_GET['meg'];
                                        } ?></div>
        </form>


      </div>
    </div>
  </div>

  <!-- <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed text-dark" data-toggle="collapse" data-target="#collapseTwo">
          掃描對獎
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse">
      <div class="card-body">
        載入掃碼器...
      </div>
    </div>
  </div> -->

  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed text-dark" data-toggle="collapse" data-target="#collapseThree">
          中獎號碼
        </button>
      </h2>
    </div>

    <div id="collapseThree" class="collapse">
      <div class="card-body">

        <div class='row justify-content-around' style="list-style-type:none;padding:0">
          <li><a href="?do=enterAwards&pd=2020-1">1,2月</a></li>
          <li><a href="?do=enterAwards&pd=2020-2">3,4月</a></li>
          <li><a href="?do=enterAwards&pd=2020-3">5,6月</a></li>
          <li><a href="?do=enterAwards&pd=2020-4">7,8月</a></li>
          <li><a href="?do=enterAwards&pd=2020-5">9,10月</a></li>
          <li><a href="?do=enterAwards&pd=2020-6 ">11,12月</a></li>
        </div>


        <table class="table table-bordered" summary="統一發票中獎號碼單">
          <tr>
            <th headers="months" class="title text-center" colspan="3">
              <?= $year; ?>年
              <?php
              $month = [
                1 => "01 ~ 02",
                2 => "03 ~ 04",
                3 => "05 ~ 06",
                4 => "07 ~ 08",
                5 => "09 ~ 10",
                6 => "11 ~ 12"
              ];
              echo $month[$period];
              ?>月
            </th>
          </tr>

          <tr>
            <th id="specialPrize">特別獎</th>
            <td headers="specialPrize" class="number" style="color:#17a2b8;">
              <?= $special; ?>
            </td>
            <td headers="specialPrize"> 1,000萬元 </td>
          </tr>
         
          <tr>
            <th id="grandPrize">特獎</th>
            <td headers="grandPrize" class="number" style="color:#17a2b8;">
              <?= $grand; ?>
            </td>
            <td headers="grandPrize"> 200萬元 </td>
          </tr>
          
          <tr>
            <th id="firstPrize">頭獎</th>
            <td headers="firstPrize" class="number" style="color:#17a2b8;">
              <?php
              foreach ($first as $f) {
                echo substr($f,0,5)."<span style='color:#d39e00;'>".substr($f,5)."</span><br>";
              };
              ?>
            </td>
            <td headers="firstPrize"> 20萬元 </td>
          </tr>

          <tr>
            <th id="addSixPrize">增開</th>
            <td headers="addSixPrize" class="number" style='color:#d39e00;'>
              <?php
              foreach ($six as $s) {
                echo $s . "<br>";
              }
              ?>
            </td>
            <td>2百元</td>
          </tr>

          <tr>
            <th id="twoPrize">二獎</th>
            <td headers="twoPrize" style="color:gray"> 末<span style="color:#17a2b8;">7</span>位數號碼與頭獎中獎號碼末<span style="color:#17a2b8;">7</span>位相同</td>
            <td>4萬元</td>
          </tr>

          <tr>
            <th id="threePrize">三獎</th>
            <td headers="threeAwards" style="color:gray">末<span style="color:#17a2b8;">6</span>位數號碼與頭獎中獎號碼末<span style="color:#17a2b8;">6</span>位相同</td>
            <td>1萬元</td>
          </tr>

          <tr>
            <th id="fourPrize">四獎</th>
            <td headers="fourPrizes" style="color:gray"> 末<span style="color:#17a2b8;">5</span>位數號碼與頭獎中獎號碼末<span style="color:#17a2b8;">5</span>位相同</td>
            <td>4千元</td>
          </tr>

          <tr>
            <th id="fivePrize">五獎</th>
            <td headers="fivePrize" style="color:gray">末<span style="color:#17a2b8;">4</span>位數號碼與頭獎中獎號碼末<span style="color:#17a2b8;">4</span>位相同</td>
            <td>1千元</td>
          </tr>

          <tr>
            <th id="sixPrize">六獎</th>
            <td headers="sixPrize" style="color:gray"> 末<span style="color:#17a2b8;">3</span>位數號碼與頭獎中獎號碼末<span style="color:#17a2b8;">3</span>位相同</td>
            <td>2百元</td>
          </tr>



          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>