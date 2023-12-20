<?php

session_start();
include_once 'config.php';
if (isset($_GET['mod'])) {
    switch ($_GET['mod']) {
        case 'page':
            include_once 'controller/c_page.php';
            break;
        case 'user':
            include_once 'controller/c_users.php';
            break;
        case 'product':
            include_once 'controller/c_product.php';
            break;
        default:

            break;
    }
} else {
    header('Location: ?mod=page&act=dashboard');
}
