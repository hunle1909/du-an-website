<div class="admin-edit">
  <h2> Sửa sản phẩm </h2>
  <form action="" method="post" enctype="multipart/form-data">
    <label for="tenhh">Tên sản phẩm:</label>
    <input type="text" name="tenhh" value="<?= $data['hanghoa']['tenhh'] ?>">
    <br>
    <label for="giaban">Giá:</label>
    <input type="number" name="giaban" min="0" value="<?= $data['hanghoa']['giaban'] ?>">

    <br>
    <label for="giakm">Giá Khuyến Mãi:</label>
    <input type="number" name="giakm" min="0" value="<?= $data['hanghoa']['giakm'] ?>">
    <br>
    <label for="img">Ảnh sản phẩm: <img src="upload/img/<?= $data['hanghoa']['img'] ?>" width="100px"> </label>
    <br>
    <input type="file" name="img" value="<?= $data['hanghoa']['img'] ?>">
    <br>
    <label for="mota">Ghi chú:</label>
    <input type="text" name="mota" value="<?= $data['hanghoa']['mota'] ?>">
    <br>
    <button type="submit" name="submit">Update</button>
  </form>
</div>