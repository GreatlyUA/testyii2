<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\module\admin\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Текстовый блок';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать Текстовый блок', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

     <?php \yii\widgets\Pjax::begin(["timeout"=>7000]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        	[
                'attribute' => 'parent_id',
                'value' => function ($model) {
                    return empty($model->parent_id) ? '---' : $model->parent->title;
                },
            ],            
            'title',
            'slug',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php \yii\widgets\Pjax::end(); ?>
    
</div>
