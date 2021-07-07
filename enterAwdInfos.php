<!-- 輸入想要儲存的發票 -->
<div class="container">
    <p>請輸入發票資料:</p>
    <form action="api/add_invoice.php" method="post">
        <div class="form-group col-12">消費日期: <input type="date" name="date"></div>
        <div class="form-group col-12">期別:
            <select name="period">
                <option value="1">1-2月</option>
                <option value="2">3-4月</option>
                <option value="3">5-6月</option>
                <option value="4">7-8月</option>
                <option value="5">9-10月</option>
                <option value="6">11-12月</option>
            </select>
        </div>
        <div class="form-group form-row col-12">發票號碼:
            <input type="text" name="code" style="width:50px">
            <input type="number" name="number" style="width:150px">
        </div>
        <div class="form-group col-12">發票金額:
            <input type="number" name="payment">
        </div>
        <div class="form-group col-12">類別:
            <select name="paytype">
                <option value="1">飲食</option>
                <option value="2">居家</option>
                <option value="3">交通</option>
                <option value="4">購物</option>
                <option value="5">娛樂</option>
                <option value="6">其他</option>
            </select>
        </div>
        <div class="text-center">
            <input type="submit" value="送出">
        </div>
    </form>
</div>