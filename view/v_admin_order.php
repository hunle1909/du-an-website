<?php $orderList = getOrder(); ?>

<table>
    <thead>
        <tr>
            <th>Mã đơn hàng</th>
            <th>Tên khách hàng</th>
            <th>Tên SP</th>
            <th>Ảnh SP</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Tổng tiền</th>
            <th>Số lượng</th>
            <th>Trạng thái</th>
            <th>Chuyển trạng thái</th>
        </tr>
    </thead>

    <tbody>

        <?php if (empty($orderList)) : ?>
            <tr>
                <td colspan="8" style="text-align: center; font-size: 30px; color: red;">Không có đơn hàng nào.</td>
            </tr>
        <?php else : ?>
            <?php $previousOrderId = null; ?>
            <?php foreach ($orderList as $order) : ?>
                <tr>
                    <?php if ($order['mals'] !== $previousOrderId) : ?>
                        <td><?= $order['mals'] ?></td>
                        <?php $previousOrderId = $order['mals']; ?>
                    <?php else : ?>
                        <td></td>
                    <?php endif; ?>

                    <td><?= $order['tenkh'] ?></td>
                    <td><?= $order['tenhh'] ?></td>
                    <td><img src="assest/img/<?= $order['img'] ?>" width="50"></td>
                    <td><?= $order['sdt'] ?></td>
                    <td><?= $order['diachi'] ?></td>
                    <td><?= $order['tongtien'] ?></td>
                    <td><?= $order['soluong'] ?></td>
                    <td>
                        <?php
                        switch ($order['trangthai']) {
                            case 'chuan-bi':
                                $statusText = 'Chuẩn bị';
                                $statusColor = 'green'; // Green for preparation
                                break;
                            case 'cho-giao':
                                $statusText = 'Đang giao hàng';
                                $statusColor = 'orange'; // Orange for delivery
                                break;
                            case 'da-giao':
                                $statusText = 'Đã giao hàng';
                                $statusColor = 'red'; // Blue for delivered
                                break;
                            default:
                                $statusText = $order['trangthai'];
                                $statusColor = 'red'; // Red for other statuses
                                break;
                        }
                        ?>

                        <span style="color: <?php echo $statusColor; ?>;">
                            <?php echo $statusText; ?>
                        </span>
                    </td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="orderId" value="<?php echo isset($order['mals']) ? $order['mals'] : ''; ?>">

                            <?php if ($order['trangthai'] == 'chuan-bi' || $order['trangthai'] == 'cho-giao') : ?>
                                <button type="submit" name="changeStatus">Đang giao</button>
                            <?php endif; ?>

                            <?php if ($order['trangthai'] == 'cho-giao') : ?>
                                <button type="submit" name="changeStatusToDelivered">Đã giao</button>
                            <?php endif; ?>

                            <?php if ($order['trangthai'] == 'da-giao') : ?>
                                <a href="admin.php?mod=product&act=invoice&mahd=<?php echo $order['mals']; ?>">Chi tiết hóa đơn</a>
                            <?php else : ?>
                                <button type="submit" name="cancelOrder">Hủy đơn</button>
                                <button type="submit" name="changeAddress">Thay đổi địa chỉ</button>
                            <?php endif; ?>
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<style>
    form button[type="submit"] {
        background-color: #285d5b;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out, transform 0.2s ease-in-out;
        margin-top: 10px;
        width: 100%;
    }
</style>