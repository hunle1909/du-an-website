<?php session_reset() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
   
    <link rel="stylesheet" href="assest/admin2.css">
    <link rel="stylesheet" href="assest/admin3.css">
    <link rel="shortcut icon" href="assest/img/logo-png.png" type="image/x-icon">

</head>

<body>
    <nav>
        <strong>
            Trang quản trị website
        </strong>

        <div>
            Xin chào, <?= $_SESSION['taikhoan']['hoten'] ?> <br>
            <small>
                <?= $_SESSION['taikhoan']['email'] ?> <br>
                <a href="index.php?mod=page&act=home">Trở về trang chủ</a>
            </small>
        </div>
    </nav>
    <div class="row">
        <div class="col-2">
            <ul>
                <li>
                    <a href="admin.php">Tổng quan</a>
                </li>
                <li>
                    <a href="admin.php?mod=product&act=admin">Sản phẩm</a>
                </li>
                <li>
                    <a href="admin.php?mod=user&act=admin">Tài khoản</a>
                </li>
                <li>
                    <a href="admin.php?mod=product&act=order">Đơn hàng</a>
                </li>

            </ul>
        </div>
        <div class="col-9">

            <style>
                body{
                    width: 100%;
                    margin: 0 auto;
                }
                nav {
                    background-color: #333;
                    color: #fff;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 10px;
                }

                nav strong {
                    font-size: 1.5rem;
                }

                nav div {
                    text-align: right;
                }

                nav small {
                    display: block;
                    color: #ccc;
                }

                .row {
                    display: flex;
                    justify-content: space-between;
                }

                .col-2{
                    flex: 1;
                    margin-right: 20px;
                    padding-right: 20px;
                    margin-left: 10px;
                }
                .col-2 a{
                    width: 70%;
                    text-align: center;
                }

                .col-9 {
                    flex: 9;
                }

                h2 {
                    margin-top: 0;
                }

                ul {
                    list-style-type: none;
                    padding: 0;
                }

                li {
                    margin: 5px 0;
                }
            </style>