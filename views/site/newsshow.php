<?php

use yii\helpers\Html;
use yii\helpers\Markdown;

$this->title = 'Новости';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['news']];
$this->params['breadcrumbs'][] = $model->name;

?>

<div class="site-contact">

    <h1><?=  Html::encode($model->name) ?></h1>

    <?php
        if(file_exists(Yii::getAlias('@webroot/uploads/News/news_image_'.$model->id.'.jpeg'))) {
            echo '<div class="col-md-4">'.Html::img('/uploads/News/news_image_'.$model->id.'.jpeg', ['class'=>'img-news']).'</div>';
        }
    ?>

    <div class="col-md-8">
        <?= Markdown::process($model->news_text) ?>
    </div>


	
    
</div>