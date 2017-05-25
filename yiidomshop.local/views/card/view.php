<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="container">
    <?php if( Yii::$app->session->hasFlash('success') ): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif;?>

    <?php if( Yii::$app->session->hasFlash('error') ): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif;?>
    
    <?php if(!empty($out['session']['card'])): ?>
        <div class="table-responsive">
            <table class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($out['session']['card'] as $id => $item):?>
                    <tr>
                        <td class="icon-img"><?= \yii\helpers\Html::img("{$item['img']}", ['alt' => $item['name'], 'height' => 50]) ?></td>
                        <td><a href="<?= Url::to(['product/view', 'id' => $id])?>"><?= $item['name']?></a></td>
                        <td><?= $item['quantity']?></td>
                        <td><?= $item['price']?></td>
                        <td><?= $item['quantity'] * $item['price']?></td>
                        <td><span data-id="<?= $id?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach?>
                <tr>
                    <td colspan="5">Итого: </td>
                    <td><?= $out['session']['card.quantity'] ?></td>
                </tr>
                <tr>
                    <td colspan="5">На сумму: </td>
                    <td><?= $out['session']['card.sum'] ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <hr/>
        <?php $form = ActiveForm::begin()?>
        <?= $form->field($out['order'], 'name')?>
        <?= $form->field($out['order'], 'email')?>
        <?= $form->field($out['order'], 'phone')?>
        <?= $form->field($out['order'], 'address')?>
        <?= Html::submitButton('Заказать', ['class' => 'btn btn-success'])?>
        <?php ActiveForm::end()?>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            <h4 class="clear"> Корзина пуста </h4>
        </div>
    <?php endif;?>
</div>
