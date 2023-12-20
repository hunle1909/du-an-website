<?php

use PgSql\Lob;

if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'admin':
            // Check admin 
            if (!(isset($_SESSION['taikhoan']) && $_SESSION['taikhoan']['quyen'] ==  1)) {
                header('Location: index.php');
            }
            include_once 'model/m_connect.php';
            include_once 'model/m_users.php';
            $data['taikhoan'] = get_users();
            // Delete users
            if (isset($_POST['delete'])) {
                $matk = $_POST['matk'];
                delete_user($matk);
            }
            include_once 'view/v_template_admin_header.php';
            include_once 'view/v_admin_user.php';
            include_once 'view/v_template_admin_footer.php';
            break;
        case 'add':
            if (!(isset($_SESSION['taikhoan']) && $_SESSION['taikhoan']['quyen'] == 1)) {
                header('Location: index.php');
            }

            include_once 'model/m_connect.php';
            include_once 'model/m_users.php';

            if (isset($_POST['submit'])) {
                if (!isset($_POST['quyen']) || $_POST['quyen'] === '') {
                    $_SESSION['error_message'] = 'Vui lòng nhập giá trị cho "Quyền"';
                } else {
                    $hoten = $_POST['hoten'];
                    $matkhau = $_POST['matkhau'];
                    $email = $_POST['email'];
                    $sdt = $_POST['sdt'];
                    $quyen = $_POST['quyen'];
                    $diachi = $_POST['diachi'];

                    $result = add_user($hoten, $matkhau, $email, $sdt, $quyen, $diachi);

                    if ($result === true) {
                    } else {
                        echo $result;
                    }
                }
            }

            include_once 'view/v_template_admin_header.php';
            include_once 'view/v_admin_user_add.php';
            include_once 'view/v_template_admin_footer.php';
            break;

        case 'edit':
            if (!(isset($_SESSION['taikhoan']) && $_SESSION['taikhoan']['quyen'] ==  1)) {
                header('Location: index.php');
            }
            include_once 'model/m_connect.php';
            include_once 'model/m_users.php';

            if (isset($_GET['matk'])) {
                $data['taikhoan'] = get_user($_GET['matk']);
            }

            if (isset($_POST['submit'])) {
                $kq = edit_user($_GET['matk'], $_POST['hoten'], $_POST['matkhau'], $_POST['email'], $_POST['sdt'], $_POST['quyen']);
                if ($kq) {
                    header('Location: admin.php?mod=user&act=admin');
                } else {
                    $thongbao = 'Error Occurred when uploading';
                }
            } else {
                $thongbao = 'Error Occurred';
            }
            include_once 'view/v_template_admin_header.php';
            include_once 'view/v_admin_user_edit.php';
            include_once 'view/v_template_admin_footer.php';
            break;
        case 'info':
            if (!(isset($_SESSION['taikhoan']))) {
                header('Location: index.php?mod=login&act=login');
            }
            include_once 'model/m_connect.php';
            include_once 'model/m_users.php';
            include_once 'view/v_template_header.php';
            include_once 'view/v_template_info.php';
            include_once 'view/v_template_footer.php';
            break;

        case 'editInfo':
            if (!isset($_SESSION['taikhoan'])) {
                header('Location: index.php?mod=login&act=login');
                exit();
            }

            include_once 'model/m_connect.php';
            include_once 'model/m_users.php';

            $user_id = $_SESSION['taikhoan']['matk'];

            if (isset($_POST['submit'])) {
                $soNha = $_POST['sonha'];

                if (!empty($soNha)) {
                    $city = $_POST['city'];
                    $district = $_POST['district'];
                    $ward = $_POST['ward'];
                    $diachi = $soNha . ', ' . $ward . ', ' . $district . ', ' . $city;

                    edit_user_address($user_id, $diachi);
                } else {
                    $error_message = "Vui lòng nhập đầy đủ thông tin địa chỉ.";
                }

                $hoTen = $_POST['hoten'];
                $matKhau = $_POST['matkhau'];
                $email = $_POST['email'];
                $sdt = $_POST['sdt'];

                edit_user_info($user_id, $hoTen, $matKhau, $email, $sdt);
            }

            include_once 'view/v_template_header.php';
            include_once 'view/v_edit-info.php';
            include_once 'view/v_template_footer.php';
            break;

        default:
            include_once 'view/v_page-error.php';
            break;
    }
}
