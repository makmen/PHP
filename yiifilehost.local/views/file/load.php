<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<div class="row files">
    <div class="col-sm-12">
        <h2><span>Загрузка</span> новых файлов</h2>
        
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

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

            <?= $form->field($out['upload'], 'file')->fileInput() ?>

            <?= Html::submitButton('Загрузить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>

        <?php ActiveForm::end() ?>
        
    </div>
</div>
