<?php
use yii\helpers\Html;
use yii\helpers\Markdown;
?>

<div class="well">
    <div class="col-md-2 imageNews">
        <?php
        
        if(file_exists(Yii::getAlias('@webroot/uploads/News/news_image_'.$model->id.'.jpeg'))) {
            echo Html::img('/uploads/News/thumbs/news_image_'.$model->id.'.jpeg', ['class'=>'img-news']);
        }
        
        ?>
    </div>
    <div class="col-md-8">
        <h2><?= Html::encode($model->name) ?></h2>
        <?= Markdown::process($model->news_anounce) ?>
        
    </div>

    
    <div class="row field-news-news_anounce">
        <div class="col-md-12 text-right">
        <?= Html::a('Подробнее', ['news', 'slug' => $model->slug], ['class' => 'btn btn-success'])  ?>
        
        </div>
    </div>
    
</div>