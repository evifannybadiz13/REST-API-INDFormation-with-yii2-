<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\Product;
use app\models\Customer;
/* @var $this yii\web\View */
/* @var $model app\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_id')->dropDownList(
    	ArrayHelper::map(Customer::find()->all(),'customer_id','name'),
    	['prompt'=>'Select Customer']
    ) ?>

    <?= $form->field($model, 'product_id')->dropDownList(
    	ArrayHelper::map(Product::find()->all(),'product_id','name'),
    	['prompt'=>'Select Product']
    ) ?>

    <?= $form->field($model, 'date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
