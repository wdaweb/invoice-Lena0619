
  
<div class="container">
<?php

$dsn="mysql:host=localhost;dbname=invoice;charset=utf8";
$pdo=new PDO($dsn,'root','');

//撈出這期發票資料
$invoices = $pdo->query("select * from `invoices` where `period`='".$_GET['period']."' && LEFT(`date`,4)='".$_GET['year']."'")->fetchAll();

//撈出該期對獎獎號
$awdNums = $pdo->query("select * from `award_numbers` where `period`='".$_GET['period']."' && `year`='".$_GET['year']."'")->fetchAll();

$year = $_GET['year'];
// echo $year."<br>";
$period = $_GET['period'];
// echo $period;




//開始對獎
$all_res=-1;
foreach($invoices as $inv){
    
    //對獎程式
    $number=$inv['number'];
    /* echo "<pre>";
    print_r($invoice);
    echo "</pre>"; */
    
    //找出獎號
    /**
     * 1.確認期數->目前的發票的日期做分析
     * 2.得到期數的資料後->撈出該期的開獎獎號
     * 
     */
    $date=$inv['date'];
    //explode('-',$date)取得日期資料的陣列,陣列的第二個元素就是月
    //月份就可以推算期數,有了期數及年份就可以找到開獎的號碼
    // $array=explode('-',$date)
    // $month=$array[1]
    // $period=ceil($month/2)
    $year=explode('-',$date)[0];
    $period=ceil(explode('-',$date)[1]/2);
    //echo "select * from award_numbers where year='$year' && period='$period'";
    //$awards=$pdo->query("select * from award_numbers where year='$year' && period='$period'")->fetchALL();
    
    /* 
    echo "<pre>";
    print_r($awards);
    echo "</pre>"; */
    
    //頭獎的其他獎號
    $awardStr=['頭','二','三','四','五','六'];

    foreach($awdNums as $award){
        switch($award['type']){
            case 1:
                //特別號=我的發票號碼
                
                if($award['number']==$number){
                    echo "發票號碼：".$number."  中了<span class='text-success'>特別獎</span><span class='text-danger'> 1,000萬元</span>!!";
                    $all_res=1;
                }
            break;
            case 2:
                
                if($award['number']==$number){
                    echo "<br>發票號碼：".$number."  中了<span class='text-success'>特獎</span><span class='text-danger'> 200萬元</span>!!";
                    $all_res=1;
                }
    
            break;
            case 3:
                $res=-1;
                for($i=5;$i>=0;$i--){
                    $target=mb_substr($award['number'],$i,(8-$i),'utf8');
                    $mynumber=mb_substr($number,$i,(8-$i),'utf8');
    
                    if($target==$mynumber){
                        
                        $res=$i;
                    }else{
                        break;
                        //continue
                    }
                }
                //判斷最後中的獎項
                if($res!=-1){
                    switch($res){
                        case 5:
                            echo "<br>發票號碼：".$number."  中了<span class='text-success'>{$awardStr[$res]}獎</span><span class='text-danger'> 2百元</span>!!";
                            $all_res=1;
                        break;
                        case 4:
                            echo "<br>發票號碼：".$number."  中了<span class='text-success'>{$awardStr[$res]}獎</span><span class='text-danger'> 1千元</span>!!";
                            $all_res=1;
                        break;
                        case 3:
                            echo "<br>發票號碼：".$number."  中了<span class='text-success'>{$awardStr[$res]}獎</span><span class='text-danger'> 4千元</span>!!";
                            $all_res=1;
                        break;
                        case 2:
                            echo "<br>發票號碼：".$number."  中了<span class='text-success'>{$awardStr[$res]}獎</span><span class='text-danger'> 1萬元</span>!!";
                            $all_res=1;
                        break;
                        case 1:
                            echo "<br>發票號碼：".$number."  中了<span class='text-success'>{$awardStr[$res]}獎</span><span class='text-danger'> 4萬元</span>!!";
                            $all_res=1;
                        break;
                        default:
                            echo "<br>發票號碼：".$number."  中了<span class='text-success'>{$awardStr[$res]}獎</span><span class='text-danger'> 20萬元</span>!!";
                            $all_res=1;
                        break;
                    }
                }
            break;
            case 4:
                if($award['number']==mb_substr($number,5,3,'utf8')){
                    echo "<br>發票號碼：".$number." 中了<span class='text-success'>增開六獎</span><span class='text-danger'> 2百元</span>!!";
                    $all_res=1;
                }
            break;
        }
    }
    


}
    if($all_res==-1){
        echo "很可惜，都沒有中";
    }

?>
</div>