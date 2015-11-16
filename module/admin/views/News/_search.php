<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\NewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= // $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), [
    'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    'options'=>['style'=>'width:250px;', 'class'=>'form-control'],
     ])  ?>

    <?= // $form->field($model, 'enabled') ?>

    <?= // $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'news_text') ?>

    <?php // echo $form->field($model, 'news_anounce') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'arhive') ?>

    <?php // echo $form->field($model, 'in_home') ?>

    <?php // echo $form->field($model, 'event_date') ?>

    <?php // echo $form->field($model, 'locale') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
