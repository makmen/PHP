<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'created_at')->textInput( ['readOnly'=>true] ) ?>

    <?= $form->field($model, 'updated_at')->textInput( ['readOnly'=>true] ) ?>

    <?= $form->field($model, 'qty')->textInput( ) ?>

    <?= $form->field($model, 'sum')->textInput( ) ?>

    <?= $form->field($model, 'status')->dropDownList([ '0' => 'Активен', '1' => 'Завершен', ]) ?>

    <?= $form->field($model, 'name')->textInput(['readOnly'=>true, 'maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['readOnly'=>true, 'maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['readOnly'=>true, 'maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['readOnly'=>true, 'maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
