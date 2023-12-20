<?php

if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'detail':
            include_once 'model/m_connect.php';
            include_once 'model/m_product.php';
            include_once 'view/v_template_header.php';
            include_once 'view/v_product-detail.php';
            include_once 'view/v_template_footer.php';
            break;

        case 'admin':
            // Check admin 
            if (!(isset($_SESSION['taikhoan']) && $_SESSION['taikhoan']['quyen'] ==  1)) {
                header('Location: index.php');
            }

            include_once 'model/m_connect.php';
            include_once 'model/m_product.php';

            // Delete Product
            if (isset($_POST['delete'])) {
                $mahh = $_POST['mahh'];
                delete_product($mahh);
            }

            // Pagination
            $productsPerPage = 6; // Set the desired number of products per page

            $soluong = count_products($productsPerPage)['soluong'];
            $sotrang = ceil($soluong / $productsPerPage);

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            $offset = ($page - 1) * $productsPerPage;
            $data['hanghoa'] = get_product($offset, $productsPerPage);


            include_once 'view/v_template_admin_header.php';
            include_once 'view/v_product_admin.php';
            include_once 'view/v_template_admin_footer.php';
            break;

            // 
        case 'add':
            if (!(isset($_SESSION['taikhoan']) && $_SESSION['taikhoan']['quyen'] ==  1)) {
                header('Location: index.php');
            }
            include_once 'model/m_connect.php';
            include_once 'model/m_product.php';

            if (isset($_POST['submit'])) {
                $giaban = $_POST['giaban'];
                $giakm = $_POST['giakm'];

                if ($giakm > $giaban) {
                    $thongbao = 'Giá khuyến mãi phải thấp hơn giá bán';
                } else {
                    $kq = add_product($_POST['tenhh'], $giaban, $giakm, $_FILES['img']['name'], $_POST['mota']);
                    if ($kq) {
                        $kq = move_uploaded_file($_FILES['img']['tmp_name'], "upload/img/" . $_FILES['img']['name']);
                        if ($kq) {
                            header('Location:?mod=product&act=admin');
                            exit();
                        } else {
                            $thongbao = 'Error Occurred';
                        }
                    } else {
                        $thongbao = 'Error Occurred';
                    }
                }
            }

            include_once 'view/v_template_admin_header.php';
            include_once 'view/v_product_admin_add.php';
            include_once 'view/v_template_admin_footer.php';
            break;

        case 'edit':
            // Check admin 
            if (!(isset($_SESSION['taikhoan']) && $_SESSION['taikhoan']['quyen'] ==  1)) {
                header('Location: index.php');
            }
            include_once 'model/m_connect.php';
            include_once 'model/m_product.php';

            if (isset($_GET['mahh'])) {
                $data['hanghoa'] = get_prd($_GET['mahh']);
            }

            if (isset($_POST['submit'])) {
                $img = $_FILES['img']['name'];
                if ($_FILES['img']['error'] != 0) {
                    $img = $data['hanghoa']['img'];
                }
                $kq = edit_product($_GET['mahh'], $_POST['tenhh'], $_POST['giaban'], $_POST['giakm'], $img,  $_POST['mota']);
                if ($kq) {
                    if ($_FILES['img']['error'] == 0) {
                        $kq = move_uploaded_file($_FILES['img']['tmp_name'], "upload/img/" . $_FILES['img']['name']);
                    }
                    if ($kq) {

                        if ($kq) {
                            header('Location: admin.php?mod=product&act=admin');
                        } else {
                            $thongbao = 'Error Occurred when uploading';
                        }
                    } else {
                        $thongbao = 'Error Occurred';
                    }
                }
            }
            include_once 'view/v_template_admin_header.php';
            include_once 'view/v_product_admin_edit.php';
            include_once 'view/v_template_admin_footer.php';
            break;
        case 'search':
            include_once 'model/m_connect.php';
            include_once 'model/m_product.php';
            if (isset($_GET['keyword'])) {
                $keyword = $_GET['keyword'];
                $products = search_products($keyword);
            }
            include_once 'view/v_template_header.php';
            include_once 'view/v_page_search.php';
            include_once 'view/v_template_footer.php';
            break;
        case 'addToCart':
            $mahh = $_GET['mahh'];
            $matk = $_SESSION['taikhoan']['matk'];
            $soluong = isset($_GET['soluong']) ? $_GET['soluong'] : 1;
            print_r($soluong);
            include_once 'model/m_connect.php';
            include_once 'model/m_product.php';
            include_once 'model/m_c_history.php';
            try {
                $kq = history_hasCart($matk);
                if ($kq) {
                    history_addtoCart($kq['mals'], $mahh, $soluong);
                } else {
                    history_add($matk, $soluong);
                    $kq = history_hasCart($matk);
                    history_addtoCart($kq['mals'], $mahh, $soluong);
                }
                $_SESSION['thongbao'] = 'Đã thêm vào giỏ hàng';
            } catch (\Throwable $th) {
                $_SESSION['error'] = 'Đã có sản phẩm trong giỏ hàng';
            }
            $detailPageUrl = '?mod=product&act=detail&mahh=' . $mahh;
            header('Location: ' . $detailPageUrl);
            break;
        case 'removeCart':
            include_once 'model/m_connect.php';
            include_once 'model/m_c_history.php';
            $matk = $_SESSION['taikhoan']['matk'];
            $mahh = $_GET['mahh'];
            $giohang = history_hasCart($matk);
            if ($giohang) {
                history_removeCart($giohang['mals'], $mahh);
            }
            header('Location: ?mod=page&act=cart');
            break;
        case 'removeCartAll':
            include_once 'model/m_connect.php';
            include_once 'model/m_c_history.php';
            $matk = $_SESSION['taikhoan']['matk'];
            $giohang = history_hasCart($matk);
            if ($giohang) {
                history_removeAllCart($giohang['mals']);
            }
            header('Location: ?mod=page&act=cart');
            break;
        case 'updateCart':
            include_once 'model/m_connect.php';
            include_once 'model/m_c_history.php';
            $matk = $_SESSION['taikhoan']['matk'];
            $giohang = history_hasCart($matk);
            if ($giohang) {
                $tongtien = $_POST['tongtien'];
                $soluong = $_POST['soluong'];
                $trangthai = 'chuan-bi';
                history_updateCart($giohang['mals'], $tongtien, $soluong, $trangthai);
                $_SESSION['thongbao_cart'] = 'Đã Đặt hàng thành công';
            }
            header('Location: ?mod=page&act=cart');
            break;
        case 'search':
            include_once 'model/m_connect.php';
            include_once 'model/m_product.php';
            if (isset($_GET['keyword'])) {
                $keyword = $_GET['keyword'];
                $products = search_products($keyword);
            }
            include_once 'view/v_template_header.php';
            include_once 'view/v_page_search.php';
            include_once 'view/v_template_footer.php';
            break;
        case 'order':
            include_once 'model/m_connect.php';
            include_once 'model/m_c_history.php';
            include_once 'model/m_product.php';
            if (!(isset($_SESSION['taikhoan']) && $_SESSION['taikhoan']['quyen'] ==  1)) {
                header('Location: index.php');
            }

            if (isset($_POST['changeStatus'])) {
                $mals = $_POST['orderId'];
                changeStatus($mals);
            }

            if (isset($_POST['changeStatusToDelivered'])) {
                $mals = $_POST['orderId'];
                if (changeStatusToDelivered($mals)) {
                    createInvoice($mals);
                }
            }
            include_once 'view/v_template_admin_header.php';
            include_once 'view/v_admin_order.php';
            include_once 'view/v_template_admin_footer.php';
            break;

            case 'invoice':
                include_once 'model/m_connect.php';
                include_once 'model/m_c_history.php';
                include_once 'model/m_product.php';
            
                if (!(isset($_SESSION['taikhoan']) && $_SESSION['taikhoan']['quyen'] == 1)) {
                    header('Location: index.php');
                    exit();
                }
            
                $mahd = isset($_GET['mahd']) ? $_GET['mahd'] : null;
            
                if ($mahd === null) {
                    echo "Không có thông tin hóa đơn";
                    exit();
                }
            
                $orderDetails = invoice($mahd);
            
                if ($orderDetails) {
                    header("Location: admin.php?mod=product&act=invoice&mahd=" . $mahd);
                    exit();
                } else {
                    echo "Không có thông tin hóa đơn";
                }
            
                include_once 'view/invoice.php';
                break;
            
        default:
            break;
    }
}
