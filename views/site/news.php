<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Menu;


$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php \yii\widgets\Pjax::begin(["timeout"=>100000]); ?>
    
    <div class="container-fluid">
	  <div class="row">
	          <?= ListView::widget([
		              'dataProvider' => $DataProvider,
		              'itemView' => '_news_item',
		              'summary'=>'', 
		          ]);     
	          ?>
	  </div>
	</div> 

	<?php \yii\widgets\Pjax::end(); ?>
	
</div>  