<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Transaction */
/* @var $form ActiveForm */
?>
<div class="transaction">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'customer_id') ?>
        <?= $form->field($model, 'product_id') ?>
        <?= $form->field($model, 'date') ?>
        <?= $form->field($model, 'amount') ?>
        <?= $form->field($model, 'price') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- transaction -->
