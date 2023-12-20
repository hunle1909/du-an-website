<h2>Giỏ hàng</h2>


<form action="?mod=product&act=updateCart" method="post">
    <input type="hidden" name="soluong" id="soluong">
    <input type="hidden" name="tongtien" id="tongtien">

    <div class="body-cart">
        <?php if (empty($ctgiohang)) : ?>
            <p style="text-align: center; font-size: 24px; color: red;">Không có sản phẩm trong giỏ hàng.</p>

        <?php else : ?>
            <table>
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Tổng tiền</th>
                        <?php if (!empty($ctgiohang)) : ?>
                            <th>Hành động</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ctgiohang as $item) : ?>
                        <tr>
                            <td><img src="upload/img/<?= $item['img'] ?>" style="width: 50px;"></td>
                            <td><?= $item['tenhh'] ?></td>
                            <td>
                                <input type="number" max="200" min="1" name="soluong" class="soluong" onchange="tinhThanhTien(this)" value="<?= $item['soluong'] ?>">
                            </td>
                            <td><?= number_format($item['giakm'], 0, '', '') . 'đ' ?></td>
                            <td><?= number_format($item['giakm'] * $item['soluong'], 0, ',', '.') . 'đ' ?></td>

                            <td>
                                <a href="?mod=product&act=removeCart&mahh=<?= $item['mahh'] ?>"><button class="delete-btn" type="button">Xóa</button></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="4">Tổng thành tiền</th>
                        <th></th>
                        <?php if (!empty($ctgiohang)) : ?>
                            <th>
                                <a href="?mod=product&act=removeCartAll"><button class="delete-btn" type="button">Xóa Hết</button></a>
                            </th>
                        <?php endif; ?>
                    </tr>
                </tfoot>
            </table>

            <?php if (!empty($ctgiohang)) : ?>
                <button class="btn-buy" type="submit">Xác Nhận Mua</button>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</form>
<script>
    function tinhThanhTien(inputElement) {
        var dsHangHoa = document.querySelectorAll('table tbody tr');
        var tongtien = 0;
        var tongSoLuong = 0;

        dsHangHoa.forEach(function(hanghoa) {
            var giatien = parseFloat(hanghoa.querySelector('td:nth-child(4)').textContent.replace('đ', '').replace(/,/g, ''));
            var soluongElement = hanghoa.querySelector('.soluong');
            var soluong = parseInt(soluongElement.value);

            if (!isNaN(giatien) && !isNaN(soluong)) {
                var tien = giatien * soluong;
                hanghoa.querySelector('td:nth-child(5)').innerText = tien.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
                tongtien += tien;
                tongSoLuong += soluong;
            }
        });

        document.querySelector('tfoot th:nth-child(2)').innerText = tongtien.toLocaleString() + 'đ';

        document.querySelector('#soluong').value = tongSoLuong;

        document.querySelector('#tongtien').value = tongtien;
    }
    tinhThanhTien();
</script>