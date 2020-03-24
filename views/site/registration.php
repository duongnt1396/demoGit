<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
?>

<div class = "row">
    <div class = "col-lg-5">

        <?php $form = ActiveForm::begin(['id' => 'registration-form',
            'enableAjaxValidation' => true]); ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'email')->input('email') ?>
        <?= $form->field($model, 'country') ?>
        <?= $form->field($model, 'city') ?>
        <?= $form->field($model, 'phone') ?>
        <div class = "form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary',
                'name' => 'registration-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>