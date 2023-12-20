<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đất Việt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
    <link rel="stylesheet" href="assest/index.css">
    <link rel="shortcut icon" href="assest/img/logo-png.png" type="image/x-icon">
    <link rel="stylesheet" href="assest/about.css">
    <link rel="stylesheet" href="assest/info.css">
    <link rel="stylesheet" href="assest/product.css">
    <link rel="stylesheet" href="assest/cart.css">
</head>

<body>
    <div class="header">
        <div class="header-box">
            <div class="header-start">
                <div class="header-img">
                    <a href="?mod=page&act=home"> <img src="assest/img/logo.jpg" alt="" width="100px"></a>
                </div>
            </div>
            <div class="header-middle">
                <div class="header-middle-nav1">
                    <a href="?mod=page&act=home">TRANG CHỦ </a>
                </div>
                <div class="header-middle-nav2">
                    <a href="?mod=page&act=product">SẢN PHẨM </a>
                </div>
                <div class="header-middle-nav3">
                    <a href="?mod=page&act=about">VỀ CHÚNG TÔI </a>
                </div>
            </div>
            <div class="header-end">
                <div class="header-end-left"></div>
                <div class="header-end-right">
                    <div class="header-search">
                        <a href="" onclick="toggleSearchBar(event)">
                            <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                        </a>
                        <div class="searchBar" id="search">
                            <form action="" class="searchBar-wrap" method="get">
                                <input type="hidden" name="mod" value="product">
                                <input type="hidden" name="act" value="search">
                                <input type="text" name="keyword" placeholder="Tìm kiếm...">
                                <input type="submit" name="submit" value="Tìm">
                            </form>
                        </div>
                    </div>

                    <?php
                    if (isset($_GET['submit'])) {
                        $keyword = trim($_GET['keyword']);

                        if (empty($keyword)) {
                            echo '<div class="search-message">Vui lòng nhập từ khóa để tìm kiếm.</div>';
                        } else {
                            $products = search_products($keyword);

                            if (empty($products)) {
                                echo '<div class="search-message">Không tìm thấy kết quả cho từ khóa "' . htmlspecialchars($keyword) . '".</div>';
                            } else {
                            }
                        }
                    }
                    ?>


                    <div class="header-users">
                        <a href="" onclick="toggleMenu(event)"><i class="fa-regular fa-user fa-lg"></i></a>
                        <div class="user-dropdown-wrap" id="subMenu">
                            <div class="user-dropdown">
                                <?php if (!(isset($_SESSION['taikhoan'])&& is_array($_SESSION['taikhoan']))) : ?>
                                    <a href="?mod=login&act=login" class="user-edit">
                                        <i class="fa-solid fa-user" style="color: #020203;"></i>
                                        <p>Đăng Nhập</p>
                                    </a>
                                <?php else : ?>
                                    <?php if (isset($_SESSION['taikhoan']) && is_array($_SESSION['taikhoan'])) : ?>
                                        <p>Xin chào , <?= $_SESSION['taikhoan']['hoten'] ?> </p>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <hr>
                                <?php if (isset($_SESSION['taikhoan']) && is_array($_SESSION['taikhoan'])) : ?>
                                    <a href="?mod=user&act=info" class="user-edit">
                                        <i class="fa-solid fa-user" style="color: #020203;"></i>
                                        <p>Thông tin tài khoản</p>
                                    </a>
                                    <a href="?mod=page&act=history" class="user-edit">
                                        <i class="fa-regular fa-heart" style="color: #000000;"></i>
                                        <p>Lịch sử mua hàng</p>
                                    </a>
                                    <a href="?mod=login&act=logout" class="user-edit">
                                        <i class="fa-solid fa-right-from-bracket" style="color: #000000;"></i>
                                        <p>Đăng xuất</p>
                                    </a>
                                <?php endif; ?>
                                <?php
                                if (isset($_SESSION['taikhoan']) && is_array($_SESSION['taikhoan']) && $_SESSION['taikhoan']['quyen'] == 1) :
                                ?>
                                    <a href="admin.php?mod=page&act=dashboard" class="user-edit">
                                        <i class="fa-solid fa-rotate-left" style="color: #000000;"></i>
                                        <p>Trở lại trang Admin</p>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="header-cart">
                        <a href="?mod=page&act=cart"><i class="fa-solid fa-cart-shopping fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    let subMenu = document.getElementById('subMenu');

    function toggleMenu() {
        event.preventDefault();
        subMenu.classList.toggle('open-menu');
    }

    let search = document.getElementById('search');

    function toggleSearchBar() {
        event.preventDefault();
        search.classList.toggle('open-searchbar');
    }
</script>