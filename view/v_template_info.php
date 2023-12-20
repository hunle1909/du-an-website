<h2>Thông Tin Tài Khoản</h2>
<?php
$user_id = $_SESSION['taikhoan']['matk'];
$user_info = get_user($user_id);
?>
<div class="form-info">
    <form method="post">
        <label for="hoTen">Họ Tên:</label>
        <input type="text" id="hoTen" name="hoTen" value="<?php echo $user_info['hoten']; ?>" readonly>

        <label for="matKhau">Mật Khẩu:</label>
        <input type="password" id="matKhau" name="matKhau" value="**********" readonly>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user_info['email']; ?>" readonly>

        <label for="sdt">Số Điện Thoại:</label>
        <input type="tel" id="sdt" name="sdt" value="<?php echo $user_info['sdt']; ?>" readonly>

        <label for="quyen">Quyền:</label>
        <input type="text" id="quyen" name="quyen" value="<?php if ($user_info['quyen'] == 1) : ?>
Admin
    <?php else : ?>
Người dùng
    <?php endif; ?>" readonly>
        <label for="diaChi">Địa Chỉ:</label>
        <input type="text" id="diaChi" name="diaChi" value="<?php echo $user_info['diachi']; ?>" readonly>
    </form>
    <div class="btn-submit">
        <button class="btn-edit"><a href="?mod=user&act=editInfo">Sửa thông tin tài khoản</a></button>
    </div>
</div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
        method: "GET",
        responseType: "application/json",
    };
    var promise = axios(Parameter);
    promise.then(function(result) {
        renderCity(result.data);
    });

    function renderCity(data) {
        for (const x of data) {
            citis.options[citis.options.length] = new Option(x.Name, x.Id);
        }
        citis.onchange = function() {
            district.length = 1;
            ward.length = 1;
            if (this.value != "") {
                const result = data.filter(n => n.Id === this.value);

                for (const k of result[0].Districts) {
                    district.options[district.options.length] = new Option(k.Name, k.IdName);
                }
            }
        };
        district.onchange = function() {
            ward.length = 1;
            const dataCity = data.filter((n) => n.Id === citis.value);
            if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

                for (const w of dataWards) {
                    wards.options[wards.options.length] = new Option(w.Name, w.Name); // Change w.Id to w.Name
                }
            }
        };
    }
</script>