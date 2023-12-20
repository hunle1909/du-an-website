<div class="body-1">
    <div class="body-1-box">
        <div class="body-1-left">
            <div class="body-1-block"></div>
            <div class="body-1-title">
                <h1>
                    Đất Việt
                </h1>
            </div>
            <div class="body-1-content">
                <p>Hương vị tinh hoa của chất lượng không chỉ là sự kết hợp hoàn hảo của các yếu tố ngon miệng,
                    mà còn là sự sáng tạo và tâm huyết, tạo nên trải nghiệm đậm chất tinh tế và độc đáo.</p>
            </div>
            <div class="body-1-commit">
                <div class="body-1-commit-1">
                    <i class="fa-solid fa-circle-check fa-lg"></i> Chính Hãng
                </div>
                <div class="body-1-commit-2">
                    <i class="fa-solid fa-circle-check fa-lg"></i> Chất Lượng
                </div>
                <div class="body-1-commit-3">
                    <i class="fa-solid fa-circle-check fa-lg"></i> Miễn Phí Vận Chuyển
                </div>

            </div>
            <div class="body-1-button">
                <a href="?mod=page&act=product"><button class="body-1-button-btn">TRUY CẬP NGAY</button></a>
            </div>
        </div>
        <div class="body-1-right">
            <div class="body-1-img">
                <img src="assest/img/img-body-1.png" alt="" width="160%">
            </div>
        </div>
    </div>
</div>
<div class="body-2">
    <div class="body-2-block-1"></div>
    <div class="body-2-box">
        <div class="body-2-1">
            <i class="fa-solid fa-user-shield fa-2xl"></i>
            <h2>Bảo mật</h2>
            <p>Thanh toán an toàn, đa dạng</p>
        </div>
        <div class="body-2-2">
            <i class="fa-solid fa-rotate fa-2xl"></i>
            <h2>Hoàn trả trong 7 ngày</h2>
            <p>Nếu có vấn đề về sàn phẩm</p>
        </div>
        <div class="body-2-3">
            <i class="fa-solid fa-headset fa-2xl"></i>
            <h2>Hỗ trợ 24/7</h2>
            <p>Đội ngũ chuyên nghiệp</p>
        </div>
        <div class="body-2-4">
            <i class="fa-solid fa-hand-holding-dollar fa-2xl"></i>
            <h2>Miễn phí vận chuyển</h2>
            <p>Khi mua từ 3 sản phẩm trở lên</p>
        </div>
    </div>
    <div class="body-2-block-2"></div>
</div>
<div class="body-3">
    <div class="container-body">
        <div class="body-3-title">
            <h2>Sản Phẩm Bán Chạy</h2>
        </div>
        <div class="body-3-product">
        <?php
        $products = get_product_limit();

        if (!empty($products)) {
            foreach ($products as $product) {
        ?>
                <div class="body-product">
                    <div class="product-img">
                    <a href="?mod=product&act=detail&mahh=<?php echo $product['mahh']; ?>">
                            <img src="upload/img/<?php echo $product['img']; ?>" width="300px" alt="<?php echo $product['tenhh']; ?>">
                        </a>
                    </div>
                    <div class="product-name">
                    <a href="?mod=product&act=detail&mahh=<?php echo $product['mahh']; ?>"><?php echo $product['tenhh']; ?></a>
                    </div>
                    <div class="price">
                        <p class="product-price">
                            <del><?php echo number_format($product['giaban']); ?>VNĐ</del>
                            <span class="product-discount"><?php echo number_format($product['giakm']); ?>VNĐ</span>
                        </p>
                    </div>
                    <div class="product-submit">
                        <!-- Thêm mã sản phẩm vào thuộc tính data-product-id -->
                        <button class="product-submit-btn" data-product-id="<?php echo $product['mahh']; ?>">
                            Thêm vào giỏ hàng
                        </button>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '<p>Không có sản phẩm bán chạy.</p>';
        }
        ?>
        </div>
    </div>
</div>