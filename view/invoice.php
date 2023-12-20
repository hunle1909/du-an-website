<?php
$orderDetails = invoice($mahd);

if ($orderDetails) {
    echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn Chi Tiết</title>
    <style>
        /* Your CSS styles here */
        /* ... */
    </style>
</head>
<body>
    <header>
        <h1>Hóa Đơn chi tiết</h1>
        <address>
            <p>Hoàng Huy</p>
            <p>L6, Landmark 6<br>Bình Thạnh, HCMC</p>
            <p>(0966) 397 954</p>
        </address>
        <span><img alt="" src="../assest/img/logo-removebg.png" width="100px"></span>
    </header>
    <article>
        <h1>Recipient</h1>
        <address>
            <!-- Recipient\'s address here -->
        </address>
        <table class="meta">
            <tr>
                <th><span>Hóa đơn số #</span></th>
                <td><span>' . $orderDetails["mahd"] . '</span></td>
            </tr>
            <tr>
                <th><span>Ngày</span></th>
                <td><span>' . $orderDetails["ngaydathang"] . '</span></td>
            </tr>
            <tr>
                <th><span>Tổng giá trị</span></th>
                <td><span id="prefix">$</span><span>' . $orderDetails["thanhtien"] . '</span></td>
            </tr>
        </table>
        <table class="inventory">
            <thead>
                <tr>
                    <th><span>Tên SP</span></th>
                    <th><span>Gía trị</span></th>
                    <th><span>Số lượng</span></th>
                    <th><span>Tổng</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a></a><span>' . $orderDetails["tenhh"] . '</span></td>
                    <td><span data-prefix>$</span><span>' . $orderDetails["TongTien"] . '</span></td>
                    <td><span>' . $orderDetails["SoLuong"] . '</span></td>
                    <td><span data-prefix>$</span><span>' . $orderDetails["TongTien"] . '</span></td>
                </tr>
            </tbody>
        </table>
        <table class="balance">
            <tr>
                <th><span>Tổng giá trị</span></th>
                <td><span data-prefix>$</span><span>' . $orderDetails["thanhtien"] . '</span></td>
            </tr>
            <tr>
                <th><span>Thuế</span></th>
                <td><span data-prefix>$</span><span>0.00</span></td>
            </tr>
            <tr>
                <th><span>Tổng tiền</span></th>
                <td><span data-prefix>$</span><span>' . $orderDetails["thanhtien"] . '</span></td>
            </tr>
        </table>
    </article>
    <aside>
        <h1><span></span></h1>
        <div>
            <!-- Additional content here -->
        </div>
    </aside>
</body>
</html>';
} else {
    echo "Không có thông tin hóa đơn";
}
?>
