<h2> Sửa Tài Khoản </h2>
<form action="" method="post">
    <label for="ten">Tên tài khoản:</label>
    <input type="text" name="hoten" value="<?=$data['taikhoan']['hoten']?>">
    <br>
    <label for="pass">Password: </label>
    <input type="text" name="matkhau" value="<?=$data['taikhoan']['matkhau']?>">
    <br>
    <label for="email">Email: </label>
    <input type="text" name="email" value="<?=$data['taikhoan']['email']?>">
    <br>
    <label for="sdt">Số điện thoại: </label>
    <input type="number" name="sdt" value="<?=$data['taikhoan']['sdt']?>">
    <br>
    <label for="role">Quyền: </label>
    <input type="text" name="quyen" value="<?=$data['taikhoan']['quyen']?>">
    <br>
    <label for="role">Địa chỉ: </label>
    <input type="text" name="diachi" value="<?=$data['taikhoan']['diachi']?>">
    <br>
    <button type="submit" name="submit" >Update</button>
</form>