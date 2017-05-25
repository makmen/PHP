<div class="clearfix"></div>
<h3 class="title text-center">Рекомендуемые товары</h3>
<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php foreach ($this->data as $k => $v): ?>
            <div class="item <?php if (!$k): ?>active<?php endif; ?>">	
                <?php foreach ($v as $kk => $vv): ?>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="recommended-products">
                                <div class="productinfo text-center">
                                    <?= \yii\helpers\Html::img("@web/upload/store/Products/Product" . $vv['id']. "/" . $vv['img'], ['alt' => $vv['name']]) ?>
                                    <h2 class="price"><span>Price: </span> <?= $vv['price'] ?></h2>
                                    <p class="name">
                                        <a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $vv['id']]) ?>"><?= $vv['name']?></a>
                                    </p>
                                    <a href="#" data-id="<?= $vv['id'] ?>"  class="btn btn-default add-cart">
                                        <span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endforeach; ?>
    </div>
    <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>			
</div>
