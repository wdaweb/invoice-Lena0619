<div class="container text-center">
<h6>對獎結果:</h6>
<?php

$dsn="mysql:host=localhost;dbname=invoice;charset=utf8";
$pdo=new PDO($dsn,'root','');

$year = $_POST['year'];
$period = $_POST['period'];
$last3num = $_POST['last3num'];
// echo $period."<br>";
// echo $last3num;

//期別 轉 月份
$periodArr = [
    '1' => '1-2月',
    '2' => '3-4月',
    '3' => '5-6月',
    '4' => '7-8月',
    '5' => '9-10月',
    '6' => '11-12月'
];
$mon = $periodArr[$period];

//撈出當期的所有得獎號碼
$sql = "select * from `award_numbers` where `period`= '$period' && `year`='$year'";
$thisPeriod = $pdo->query($sql)->fetchALL(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($thisPeriod);
// echo "</pre>";

//開始對獎

$all_res = -1;
if(empty($thisPeriod)){

    header("location:?do=enterAwards&meg=無此期別對獎資料");      

} elseif(is_numeric($last3num)){
    
foreach($thisPeriod as $award){
   
    switch($award['type']){
        case 1:  
            if(substr($award['number'],-3) == $last3num){
                header("location:?do=enterAwards&meg=發票後三碼:".$last3num."<br>注意特別獎!</br>".$year."/".$mon." ".$award['number']."<br>全部數字相同 特別獎 1000萬元");
                $all_res=1;
                // echo "發票後三碼: ".$last3num."<br>";
                // echo "注意特別獎!"."<br>";
                // echo $year."/".$mon." ".$award['number']."<br>";
                // echo "全部數字相同 特別獎 1000萬元";
                // $all_res=1;
                
            };
        break;

        case 2:
            if(substr($award['number'],-3) == $last3num){
                header("location:?do=enterAwards&meg=發票後三碼:".$last3num."<br>注意特獎!</br>".$year."/".$mon." ".$award['number']."<br>全部數字相同 特獎 200萬元");
                $all_res=1;
                // echo "發票後三碼: ".$last3num."<br>";
                // echo "注意特獎!"."<br>";
                // echo $year."/".$mon." ".$award['number']."<br>";
                // echo "全部數字相同 特獎 200萬元";
                // $all_res=1;
            };
        break;

        case 3:
            if(substr($award['number'],-3) == $last3num){
                header("location:?do=enterAwards&meg=發票後三碼:".$last3num."<br>恭喜中獎!</br>".$year."/".$mon." ".$award['number']."<br>頭獎: 全中 20萬元; 末七碼 4萬; 末六碼 1萬;"."<br>"."末五碼 4千; 末四碼 1千; 末三碼 2百");
                $all_res=1;
                // echo "發票後三碼: ".$last3num."<br>";
                // echo "恭喜中獎!"."<br>";
                // echo $year."/".$mon." ".$award['number']."<br>";
                // echo "頭獎: 全中 20萬元; 末七碼 4萬; 末六碼 1萬;"."<br>"."末五碼 4千; 末四碼 1千; 末三碼 2百;";
                // $all_res=1;
            };
        break;

        case 4:
            if(substr($award['number'],-3) == $last3num){
                header("location:?do=enterAwards&meg=發票後三碼:".$last3num."<br>恭喜中獎!</br>".$year."/".$mon." ".$award['number']."<br>增開六獎 200元");
                $all_res=1;
                // echo "發票後三碼: ".$last3num."<br>";
                // echo "恭喜中獎!"."<br>";
                // echo $year."/".$mon." ".$award['number']."<br>";
                // echo "增開六獎 200元";
                // $all_res=1;
            };
        break;
        // default:
        //     echo "沒中!"."<br>";
        //     echo "別氣餒,再接再厲!";
        // break;
    }


} 
if ($all_res==-1) {
    header("location:?do=enterAwards&meg=沒中!<br>別氣餒,再接再厲!");
}

   
} else {

header("location:?do=enterAwards&meg=請輸入發票末三碼!");
}

?>
</div>