<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
?>
<?php if (!empty($out['products'])): ?>
    <?php foreach ($out['products'] as $k=>$product): ?>

    <?php $mainImg = $product->getImage(); ?>

    <div class="products-row <?php if ( !(($k+1)%3) ): ?>clearfix<?php endif; ?>">
        <div class="col-sm-4">
            <div class="product">
                <div class="product-favorites">
                    <?php if ($product->new): ?>
                        <?= Html::img("@web/images/new.png", ['alt' => 'Новинка', 'class' => 'new']) ?>
                    <?php endif; ?>
                    <?php if ($product->sale): ?>
                        <?= Html::img("@web/images/sale.png", ['alt' => 'Распрадажа', 'class' => 'new']) ?>
                    <?php endif; ?>
                </div><!-- /.product-favorites -->
                <div class="product-img">
                    <?= Html::img( $mainImg->getUrl('270x250')  , ['alt' => $product->name]) ?>
                </div><!-- /.product-img -->
                <p class="product-title">
                    <a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $product->id]) ?>"><?= $product->name ?></a>
                </p>
                <p class="product-desc">
                    <?= $product->description ?>
                </p>
                <div class="product-buy">
                    <p class="product-price">
                        Price: <?= $product->price ?>
                    </p>
                    <a href="#" data-id="<?= $product->id?>" class="btn btn-default add-cart">
                        <span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;add to cart
                    </a>
                </div><!-- /.product-buy -->
            </div><!-- /.product -->
        </div>
    </div>
    <?php endforeach; ?>
<?php else: ?>
<div class="alert alert-warning" role="alert">
    <h4 class="clear">В этой категории пока еще нет товаров</h4>
</div>
<?php endif; ?>