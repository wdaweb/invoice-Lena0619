<?php

if(!empty($_GET['meg'])){
    echo "<p style='color:red;'>".$_GET['meg']."</p>";
} 

?>


<div><a href="?do=add_luckynum"><i class="fas fa-plus"></i> 新增兌獎號碼</div>
<!-- <div><a href="?do=edit_luckynum">編輯兌獎號碼</div> -->
<div><a href="?do=del_luckynum"><i class="fas fa-minus"></i> 刪除兌獎號碼</div>