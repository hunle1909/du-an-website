    <h2>Sửa Thông Tin Tài Khoản</h2>
    <?php
    $user_id = $_SESSION['taikhoan']['matk'];
    $user_info = get_user($user_id);
    ?>


    <div class="form-info">
        <form method="post">
            <label for="hoTen">Họ Tên:</label>
            <input type="text" id="hoTen" name="hoten" value="<?php echo $user_info['hoten']; ?>" pattern="[A-Za-zÀ-Ỹà-ỹ\s]+">

            <label for="matKhau">Mật Khẩu:</label>
            <input type="password" id="matKhau" name="matkhau" value="1234">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user_info['email']; ?>" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
            <?php if (isset($thongbao)) : ?>
                <div class="error-message"><?php echo $thongbao; ?>
                </div>
            <?php endif; ?>
            <label for="sdt">Số Điện Thoại:</label>
            <input type="tel" id="sdt" name="sdt" value="<?php echo $user_info['sdt']; ?>" pattern="0\d{9}">

            <label for="quyen">Quyền:</label>
            <input type="text" id="quyen" name="quyen" readonly value="<?php if ($user_info['quyen'] == 1) : ?>
    Admin
        <?php else : ?>
    Người dùng
        <?php endif; ?>">

            <label for="diaChi">Địa chỉ hiện tại:</label>
            <?php
            $diachiValue = !empty($user_info['diachi']) ? $user_info['diachi'] : 'Chưa có địa chỉ';
            ?>
            <input type="text" id="diaChi" name="diachi" readonly value="<?php echo $diachiValue; ?>" style="color: red;">

            <label for="updateDiaChi">Cập Nhật Địa Chỉ mới:</label>
            <div>
                <label for="city">Tỉnh thành:</label>
                <input type="text" id="city" name="city">

                <label for="district">Quận huyện:</label>
                <input type="text" id="district" name="district">

                <label for="ward">Phường xã:</label>
                <input type="text" id="ward" name="ward">
            </div>

            <label for="sonha">Số Nhà: </label>
            <input type="text" id="sonha" name="sonha" value="">
            <div class="btn-submit">
                <button class="btn" type="submit" name="submit">Lưu thay đổi</button>
            </div>
        </form>
    </div>