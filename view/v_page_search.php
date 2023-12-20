<div class="product-article">
<?php if (!empty($products)) : ?>
    <?php foreach ($products as $product) : ?>
    <div class="body-product">
            <div class="body-product-1">

                <a href="?mod=product&act=detail&mahh=<?= $product['mahh'] ?>">
                    <div class="product-img">
                        <img src="upload/img/<?= $product['img'] ?>" width="250px">
                    </div>
                </a>
                <div class="product-name">
                    <b><?= $product['tenhh'] ?></b>
                </div>
                <div class="price">
                    <p class="product-price">
                        <del><?= number_format($product['giakm'], 0, ',', '.') ?> &#8363;</del>
                    </p>
                    <span class="product-discount"><?= number_format($product['giaban'], 0, ',', '.') ?> &#8363;</span>
                </div>
                <div class="product-submit">
                    <a href="?mod=product&act=addToCart&mahh=<?= $product['mahh'] ?>"></a>
                    <button class="product-submit-btn">Thêm vào giỏ hàng</button>
                </div>

            </div>

    </div>
                    <?php endforeach; ?>
<?php else : ?>
    <p>No products found.</p>
<?php endif; ?>
</div>