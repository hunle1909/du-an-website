<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="assest/register.css">
    <link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
    <link rel="shortcut icon" href="logo-removebg.png" type="image/x-icon">
</head>

<body>
    <?php
    if (isset($_SESSION['thongbao'])) {
        echo '<div class="alert alert-danger" role="alert">';
        echo $_SESSION['thongbao'];
        echo '</div>';

        unset($_SESSION['thongbao']);
    }
    ?>
    <h1 class="w3ls">Đăng Nhập</h1>
    <div class="content-w3ls">
        <div class="content-agile1">
        </div>
        <div class="content-agile2">
            <form action="#" method="post">
                <div class="form-control w3layouts">
                    <input type="text" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-control agileinfo">
                    <input type="password" class="lock" id="password1" name="matkhau" placeholder="Mật khẩu" required>
                </div>
                <input type="submit" name="submit-login" id="submit-login" class="register" value="Đăng nhập">
                <?php
                if (isset($thongbao)) {
                    echo '<p style="color: red;">' . $thongbao . '</p>';
                } else {
                    unset($thongbao);
                }
                ?>

            </form>

        </div>
        <h1 class="register-now">
            Bạn chưa có tài khoản? <a href="?mod=login&act=register">Đăng ký ngay</a>
        </h1>
        <h1 class="register-now">
            <a href="?mod=page&act=home">Trở về trang chủ</a>
        </h1>
        <div class="clear"></div>
    </div>
    <p style="text-align: center;">Copyright &copy; 2023 - By Dat Viet Coffee</p>
</body>

</html>