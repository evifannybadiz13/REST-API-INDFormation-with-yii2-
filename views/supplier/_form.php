<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Supplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'item_supplied')->dropDownList(['Snack and Candy' => 'Snack and Candy',
                                                    'Beverages' => 'Beverages','Milk and Breakfast' => 'Milk and Breakfast', 
                                                    'Personal Care' => 'Personal Care', 'Medicine' => 'Medicine', 'Cooking' => 'Cooking',
                                                    'Baby and Kids' => 'Baby and Kids',  'Underware' => 'Underware', 'Electronic' => 'Electronic',  ],
                                                    ['prompt' => 'Select Option']) ?>

    <?= $form->field($model, 'distributor_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
