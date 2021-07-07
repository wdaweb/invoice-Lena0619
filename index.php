<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> 
    <title>發票對獎系統</title>
</head>
<body>

<!-- video -->

    <video autoplay="autoplay" loop="true" muted="true" preload="auto" id="fullVid">
        <source src="video2.mp4" type="video/mp4">
    </video>

<div class="container my-5">
   <div class="col-md-10 col-lg-8 mx-auto">
      
      <!-- 選單 -->
      <ul class="nav nav-tabs justify-content-around">
          <li class="nav-item">
            <a class="nav-link p-2" href="?do=keepAcc">MY</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-2" href="?do=enterAwards">對獎器</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-2" href="?do=invoiceDeposit">發票存摺</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-2" href="?do=adminLogin">管理</a>
          </li>
      </ul>
       
       <!-- 內容展示區 -->
       <div class="bg-light">
          <?php
             if(isset($_GET['do'])){

                 $file = $_GET['do'].".php";
                 include_once $file;

             } else {

                 include_once "keepAcc.php";

             }
           ?>
       </div>

   </div>
</div>

  

</body>
</html>