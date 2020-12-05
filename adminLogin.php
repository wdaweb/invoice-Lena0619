
<div class="container">
<?php
if(!empty($_GET['meg'])){
    echo "<p style='color:red;'>".$_GET['meg']."</p>";
} 
?>
<p class="py-4">請登入管理員帳號:</p>
  <form action="api/checklog.php" method="post">
      <div class="form-group">
         <label for="acc">帳號</label>
         <input type="text" class="form-control" name="acc">
      </div>
      <div class="form-group">
         <label for="pw">密碼</label>
         <input type="password" class="form-control" name="pw">
      </div>

      <input type="submit" class="btn btn-primary mb-4" value="送出">
  </form>
</div>