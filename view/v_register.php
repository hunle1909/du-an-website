<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí</title>
    <link rel="stylesheet" href="assest/register.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
    <link rel="shortcut icon" href="logo-removebg.png" type="image/x-icon">
</head>

<body>
    <h1 class="w3ls">Đăng kí</h1>
    <div class="content-w3ls">
        <div class="content-agile1">
        </div>
        <div class="content-agile2">
            <form action="" method="post">
                <div class="form-control w3layouts">
                    <input type="text" id="firstname" name="firstname" placeholder="Họ Tên" required="" pattern="[A-Za-zÀ-Ỹà-ỹ\s]+">
                </div>

                <div class="form-control w3layouts">
                    <input type="email" id="email" name="email" placeholder="Email" required="" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">

                </div>
                <?php
                    if (isset($thongbao)) {
                        echo '<p style="color: red;">' . $thongbao . '</p>';
                    } else {
                        unset($thongbao);
                    }
                    ?>
                <div class="form-control w3layouts">
                    <input type="number" id="sdt" name="sdt" placeholder="Số Điện Thoại" required="" pattern="0\d{9}">
                </div>

                <div class="form-control agileinfo">
                    <input type="password" class="lock" name="password" placeholder="Mật khẩu" id="password1" required="">
                </div>

                <div class="form-control agileinfo">
                    <input type="text" class="lock" name="diachi" placeholder="Địa chỉ" required="">
                </div>
                <input type="submit" name="submit-register" class="register" value="Đăng kí">

            </form>
        </div>
        <div class="clear"></div>
    </div>
    <p style="text-align: center;">Copyright &copy; 2023 - By Dat Viet Coffee</p>
</body>

</html>