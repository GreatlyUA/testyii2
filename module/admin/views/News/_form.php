<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'type')->dropDownList(
    array(1=>'News', 2=>'Events'), 
    array('style'=>'width:100px')
    ) 
    //,3=> 'Rss'
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), [
    'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    'options'=>['style'=>'width:250px;', 'class'=>'form-control'],
     ]) ?>

    <?php
	    if(file_exists(Yii::getAlias('@webroot/uploads/News/news_image_'.$model->id.'.jpeg')))
	    { 
	        echo Html::img('/uploads/News/news_image_'.$model->id.'.jpeg', ['class'=>'img-responsive']);
	        echo $form->field($model,'del_img')->checkBox(['class'=>'span-1']);
	    }
	   
	?> 
     
    <?= $form->field($model, 'file')->fileInput() ?> 
     
    <?= $form->field($model, 'news_anounce')->textarea(['rows' => 4]) ?>
    
    <?= $form->field($model, 'news_text')->widget(\yii\redactor\widgets\Redactor::className(), 
    ['clientOptions' => [
        'lang' => 'ru',
        'plugins' => ['fontcolor','imagemanager']
    ]
    ]) ?>
  
     <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
