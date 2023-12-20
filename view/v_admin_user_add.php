<div class="admin-add">
    <h2> Thêm tài khoản </h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="hoten">Họ Tên:</label>
        <input type="text" name="hoten" pattern="[A-Za-zÀ-Ỹà-ỹ\s]+">
        <br>
        <label for="matkhau">Mật Khẩu:</label>
        <input type="password" name="matkhau" id="matkhau">
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
        <br>
        <label for="sdt">Số điện thoại:</label>
        <input type="number" name="sdt" pattern="0\d{9}">
        <br>
        <label for="quyen">Quyền: (Nhập 1 là Admin & 0 là người dùng) </label>
        <input type="number" name="quyen" min="0" max="1" value="0">
        <br>
        <label for="diachi">Địa chỉ: </label>
        <input type="text" name="diachi">
        <br>

        <button type="submit" name="submit">Thêm tài khoản: </button>
    </form>

    <?php
    if (isset($_SESSION['error_message'])) {
        echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }
    ?>
    
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quyenInput = document.querySelector('input[name="quyen"]');

        quyenInput.addEventListener('change', function() {
            var quyenValue = quyenInput.value;

            if (quyenValue !== '0' && quyenValue !== '1') {
                alert('Quyền chỉ được nhập 0 hoặc 1');
                quyenInput.value = '';
            }
        });
    });
</script>