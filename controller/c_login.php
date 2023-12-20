<?php

use PgSql\Lob;

if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'login':
            include_once 'model/m_connect.php';
            include_once 'model/m_login.php';
            if (isset($_POST['submit-login'])) {
                $kq = login($_POST['email'], $_POST['matkhau']);
                $_SESSION['taikhoan'] = $kq;
                if ($kq) {

                    header(("Location: ?mod=page&act=home"));
                    if ($kq['quyen'] == 1) {
                        header("Location: admin.php");
                        exit();
                    } else {
                        header("Location: index.php");
                    }
                } else {
                    $thongbao = 'Tài khoản hoặc mật khẩu không đúng!';
                }
            }
            include_once 'view/v_login.php';
            break;
        case 'logout':
            unset($_SESSION['taikhoan']);
            header('Location: ?mod=page&act=home');
            break;
        case 'register':
            include_once 'model/m_connect.php';
            include_once 'model/m_login.php';
            if (isset($_POST['submit-register'])) {
                $kq = checkUser($_POST['email']);
                if ($kq) {
                    $thongbao = 'Email đã tồn tại';
                } else {
                    $hoten = $_POST['firstname'];
                    $sdt = $_POST['sdt'];
                    $email = $_POST['email'];
                    $matkhau = $_POST['password'];
                    $diachi = isset($_POST['diachi']) ? $_POST['diachi'] : '';
                    $kq = register($hoten, $sdt, $email, $matkhau, $diachi);
            
                    if ($kq) {
                        header('Location: ?mod=login&act=login');
                    } else {
                        $thongbao = 'Có lỗi xảy ra, vui lòng thử lại';
                    }
                }
            }
            include_once 'view/v_register.php';
            break;
           
        default:
            break;
    }
}
