<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['site/entry']
]);?>

<?= $form->field($model, 'name')->label('Tên của bạn Name') ?>
<?= $form->field($model, 'email')->label('Địa chỉ Email') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>