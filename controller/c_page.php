<?php

// Quản lí trang chủ + blabla...
// Gọi đến model m_CSDL, view 
if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'home':
            include_once 'model/m_connect.php';
            include_once 'model/m_product.php';
            include_once 'view/v_template_header.php';
            include_once 'view/v_page.php';
            include_once 'view/v_template_footer.php';
            break;
        case 'product':
            include_once 'model/m_connect.php';
            include_once 'model/m_product.php';

            include_once 'view/v_template_header.php';
            include_once 'view/v_product.php';
            include_once 'view/v_template_footer.php';
            break;
        case 'about':
            include_once 'model/m_connect.php';
            include_once 'view/v_template_header.php';
            include_once 'view/v_about.php';
            include_once 'view/v_template_footer.php';
            break;
        case 'dashboard':
            // Check admin 
            include_once 'model/m_connect.php';
            include_once 'model/m_product.php';
            if (!(isset($_SESSION['taikhoan']) && $_SESSION['taikhoan']['quyen'] ==  1)) {
                header('Location: index.php');
            }


            include_once 'view/v_template_admin_header.php';

            $totalCustomers = getTotalCustomers();
            $totalProducts = getTotalProducts();
            $totalOrders = getTotalOrders();
            
            include_once 'view/v_admin_dashboard.php';
            include_once 'view/v_template_admin_footer.php';
            break;
        case 'cart':
            include_once 'model/m_connect.php';
            include_once 'model/m_c_history.php';
            include_once 'model/m_product.php';
            $ctgiohang = [];

            if (isset($_SESSION['taikhoan']['matk'])) {
                $matk = $_SESSION['taikhoan']['matk'];
                $giohang = history_hasCart($matk);

                if ($giohang) {
                    $ctgiohang = history_getCart($matk);
                }
            }
            include_once 'view/v_template_header.php';
            include_once 'view/v_cart.php';
            include_once 'view/v_template_footer.php';
            break;
        case 'history':
            include_once 'model/m_connect.php';
            include_once 'model/m_c_history.php';
            include_once 'model/m_product.php'; 
            $matk = $_SESSION['taikhoan']['matk'];
            $dsLichSu = history_getAll($matk);
            include_once 'view/v_template_header.php';
            include_once 'view/v_history_cart.php';
            include_once 'view/v_template_footer.php';
            break;
    }
}
