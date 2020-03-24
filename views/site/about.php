<?php
/* @var $this yii\web\View */
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => 'yii, developing, views,
      meta, tags']);
$this->registerMetaTag(['name' => 'description',
    'content' => 'This is the description of this page!'], 'description');
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>
    <?php
    echo DateTimePicker::widget([
        'name' => 'dp_1',
        'type' => DateTimePicker::TYPE_INPUT,
        'value' => '23-Feb-1982 10:10',
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-M-yyyy hh:ii'
        ]
    ]);
    ?>
</div>