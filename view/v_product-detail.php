<?php
$products = get_product();
$product = null;
if (isset($_GET['mahh'])) {
    $productIdToShow = $_GET['mahh'];
    foreach ($products as $prod) {
        if ($prod['mahh'] == $productIdToShow) {
            $product = $prod;
            break;
        }
    }
}
?>

<body>
    <div class="product_detail">
        <?php if ($product !== null) : ?>
            <div class="row">
                <div class="col">
                    <img src="<?php echo 'upload/img/' . $product['img']; ?>" width="350px">
                </div>
                <div class="col">
                    <h2 class="product-name"><?php echo $product['tenhh']; ?></h2>
                    <p class="product-price">
                        <del><?php echo number_format($product['giaban'], 0, ',', '.') . ' ₫'; ?></del>
                        <span class="product-discount"><?php echo number_format($product['giakm'], 0, ',', '.') . ' ₫'; ?></span>
                    </p>
                    <div class="product-description">
                        <?php echo $product['mota']; ?>
                    </div>
                    <?php if (isset($_SESSION['taikhoan']['matk'])) : ?>
                        <div class="add-cart">
                            <?php if (!isset($_SESSION['taikhoan']['diachi']) || $_SESSION['taikhoan']['diachi'] === '') : ?>
                                <div class="update-info">
                                    <p class="error-message">Vui lòng cập nhật địa chỉ trước khi mua hàng.</p>
                                    <a href="?mod=user&act=editInfo">Nhấn vào đây để cập nhật địa chỉ</a>
                                </div>
                            <?php else : ?>
                                <div class="quantity">
                                    <button class="quantity-btn" onclick="decreaseQuantity()">-</button>
                                    <input type="number" id="soluong" name="soluong" min="1" max="200" value="1" oninput="updateQuantity(0)">
                                    <button class="quantity-btn" onclick="increaseQuantity()">+</button>
                                </div>
                                <a id="addToCartLink" href="?mod=product&act=addToCart&mahh=<?php echo $product['mahh']; ?>">
                                    <button class="add-to-cart">
                                        Thêm vào giỏ hàng
                                    </button>
                                </a>
                            <?php endif; ?>
                        </div>

                    <?php else : ?>
                        <?php
                        $_SESSION['error'] = " Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.";
                        ?>
                    <?php endif; ?>

                    <?php
                    if (isset($_SESSION['thongbao'])) {
                        echo '<div class="alert success">
                        <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
                    ' . $_SESSION['thongbao'] . ' 
                        </div>';
                        unset($_SESSION['thongbao']);
                    }

                    if (isset($_SESSION['error'])) {
                        echo '<div class="alert ">
                    <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
                    ' . $_SESSION['error'] . ' 
                </div>';
                        unset($_SESSION['error']);
                    }
                    ?>



                    <div class="cate">
                        <span>Danh mục: <a href="">Cà phê</a></span>
                    </div>
                </div>
            </div>
    </div>

<?php else : ?>
    <p>Không có sản phẩm</p>
<?php endif; ?>
</body>

<script>
    function updateQuantity(value) {
        var quantityInput = document.getElementById('soluong');
        var updatedQuantityValue = parseInt(quantityInput.value) + value;
        var addToCartLink = document.getElementById('addToCartLink');

        if (updatedQuantityValue < 1) {
            updatedQuantityValue = 1;
        }
        if (updatedQuantityValue > 200) { // Updated maximum quantity
            updatedQuantityValue = 200;
        }

        quantityInput.value = updatedQuantityValue;
        addToCartLink.href = "?mod=product&act=addToCart&mahh=<?php echo $product['mahh']; ?>&soluong=" + updatedQuantityValue;
        console.log(addToCartLink.href);
    }

    function decreaseQuantity() {
        updateQuantity(-1);
    }

    function increaseQuantity() {
        updateQuantity(1);
    }
</script>