<h2>Lịch sử mua hàng</h2>
<?php $dsLichSu = history_getAll($matk); ?>
<?php if (empty($dsLichSu)) : ?>
    <tr>
        <td colspan="4" style="color: red; text-align: center; font-size: 16px; font-weight: bold;">Không có lịch sử mua hàng</td>
    </tr>
<?php else : ?>
    <div class="body-cart">
        <table class="table">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tên sản phẩm</th>

                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dsLichSu as $ls) : ?>
                    <tr>
                        <td><?= $ls['mals'] ?></td>
                        <td><?= $ls['tenhh'] ?></td>

                        <td><?= $ls['soluong'] ?></td>
                        <td><?= $ls['tongtien'] ?>&#8363;</td>
                        <td>
                            <?php
                            switch ($ls['trangthai']) {
                                case  'gio-hang';
                                    echo 'Đang mua hàng';
                                    break;
                                case 'chuan-bi':
                                    echo 'Đã tiếp nhận';
                                    break;
                                case 'cho-giao':
                                    echo 'Đang giao hàng';
                                    break;
                                case 'da-giao':
                                    echo 'Đã giao hàng';
                                    break;
                                default:
                                    echo $ls['trangthai'];
                                    break;
                            }
                            ?>
                        </td>
                        <td>
                            <?php if ($ls['trangthai'] == 'da-giao') : ?>
                                <a href="#">Xem chi tiết hóa đơn</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>