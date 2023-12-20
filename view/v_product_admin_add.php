<div class="admin-add">
<h2> Thêm sản phẩm </h2>
<form action="" method="post" enctype="multipart/form-data">
    <label for="tenhh">Tên sản phẩm:</label>
    <input type="text" name="tenhh">
    <br>
    <label for="giaban">Giá:</label>
    <input type="number" name="giaban" id="giaban" min="0">
    <br>
    <label for="giakm">Giá Khuyến Mãi:</label>
    <input type="number" name="giakm" id="giakm" min="0">
    <div id="thongbao" style="color: red;"><?php echo isset($thongbao) ? $thongbao : ''; ?></div>
    <br>
    <label for="img">Ảnh sản phẩm:</label>
    <input type="file" name="img">
    <br>
    <label for="mota">Ghi chú</label>
    <input type="text" name="mota">
    <br>
    <button type="submit" name="submit">Thêm sản phẩm</button>
</form>
</div>