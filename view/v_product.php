<div class="container-box-about">
    <div class="container-box1">
        <nav>
            <span class="first-text">
                <a href="">Trang chủ</a>
            </span>
            <span class="middle-text">/</span>
            <span class="last-text">Sản Phẩm</span>
        </nav>
    </div>
    <div class="container-box2">
        <h2>Sản Phẩm</h2>
    </div>
</div>



<div class="product-article">
    <?php
    $products = get_product();
    foreach ($products as $product) {
        echo '
        <div class="body-product-1">
            <a href="?mod=product&act=detail&mahh=' . $product['mahh'] . '">
                <div class="product-img"><img src="upload/img/' . $product['img'] . '" width="250px"></div>
            </a>
            <div class="product-name"><b>' . $product['tenhh'] . '</b></div>
            <div class="price">
            <p class="product-price"><del>' . number_format($product['giaban'], 0, ',', '.') . ' &#8363;</del></p>
            <span class="product-discount">' . number_format($product['giakm'], 0, ',', '.') . ' &#8363;</span>
            
            </div>
            
            <div class="product-submit"><a href="?mod=product&act=detail&mahh=' . $product['mahh'] . '"> <button class="product-submit-btn">Chi tiết sản phẩm</button></a></div>
        </div>';
    }
    ?>
</div>