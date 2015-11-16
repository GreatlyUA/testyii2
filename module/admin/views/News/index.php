<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\DateRange;
use kartik\date\DatePicker;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;
use yii\imagine\Image;
/* @var $this yii\web\View */
/* @var $searchModel app\module\admin\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<div class="news-index">
	
    <h1><?= Html::encode($this->title) ?></h1>
       
    <p>
        <?= Html::a('Добавить новость', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php \yii\widgets\Pjax::begin(["timeout"=>7000]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [    
                'label' => 'Статус',    
                'content' => function ($model, $key, $index, $column) {
                 $en = array('Нажмите для активации','Нажмите для де активации');
                 return '<span id="enable'.$model->id.'"><a title="'.$en[$model->status].'" class="enabled'.$model->status.'" href="status/'.$model->id.'"></span>';
                 
                }
            ],
	        [    
	            'label' => 'На главную',    
	            'content' => function ($model, $key, $index, $column) {
	             $en = array('Нажмите для активации','Нажмите для де активации');
	             return '<span id="enable'.$model->id.'"><a title="'.$en[$model->in_home].'" class="enabled'.$model->in_home.'" href="inhome/'.$model->id.'"></span>';
	             
	            }
	        ],
	        
	        [    
	            'label' => 'Фото',    
	            'content' => function ($model, $key, $index, $column) {
	             $fileName = '/uploads/News/thumbs/news_image_'.$model->id.'.jpeg';
	             if(file_exists(Yii::getAlias('@webroot'.$fileName)))
	             	return Html::img($fileName,['alt'=> $model->name, 'width'=> 100]);
	             
	            }
	        ],
	        
            'name',
            'slug',
           [
            'filter' => DatePicker::widget([
                'model' => $searchModel,
                'attribute' => 'date',
                'pluginOptions' => ['format' => 'yyyy-mm-dd']
            ]),
            'attribute' => 'date',
        ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    
	<?php \yii\widgets\Pjax::end(); ?>
        
    </div>
    
</div>