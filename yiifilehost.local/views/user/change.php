<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="register">
    
    <h2><span>Форма</span> редактирования данных пользователя</h2>
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

    <?php $form = ActiveForm::begin(  ); ?>
    
        <?= $form->field($out['change'], 'passwordold')->passwordInput(['maxlength' => true, 'class' => 'text']) ?>
        <?= $form->field($out['change'], 'passwordnew')->passwordInput(['maxlength' => true, 'class' => 'text']) ?>
        <?= $form->field($out['change'], 'repasswordnew')->passwordInput(['maxlength' => true, 'class' => 'text']) ?>

    <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>

    <?php ActiveForm::end(); ?>
  
</div>