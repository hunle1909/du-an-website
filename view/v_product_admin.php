<h2> Sản phẩm </h2>
<a href="admin.php?mod=product&act=add">Thêm sản phẩm</a>
<br>

<table>
    <thead>
        <tr>
            <th>Mã Hàng Hóa</th>
            <th>Tên Hàng Hóa</th>
            <th>Gía sản phẩm</th>
            <th>Gía Khuyến Mãi</th>
            <th>Ảnh</th>
            <th>Mô Tả</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $products = get_product();
        foreach ($products as $product) {
            echo '
    <tr>
        <td>' . $product['mahh'] . '</td>
        <td>' . $product['tenhh'] . '</td>
        <td>' . $product['giaban'] . ' đ</td>
        <td style="color: red;">' . $product['giakm'] . ' đ</td>
        <td><img src="upload/img/' . $product['img'] . '" width="100%"></td>
        <td>' . $product['mota'] . '</td>
        <td>
            <form method="POST">
                <input type="hidden" name="mahh" value="' . $product['mahh'] . '">
                <a href="admin.php?mod=product&act=edit&mahh=' . $product['mahh'] . '">Sửa</a>
                <input type="submit" value="Xóa" name="delete" onclick="return confirmDelete();">
            </form>
        </td>
    </tr>';
        }
        ?>

    </tbody>
</table>
<div class="pagination">
    <?php for ($i = 1; $i <= $sotrang; $i++) : ?>
        <a href="?mod=product&act=admin&page=<?= $i ?>"><?= $i ?></a>
    <?php endfor; ?>
</div>

<script>
    function confirmDelete() {
        var result = confirm("Bạn có chắc chắn muốn xóa sản phẩm này?");
        return result;
    }
</script>