<?php

namespace app\module\admin;

class AdminModule extends \yii\base\Module
{
    public $controllerNamespace = 'app\module\admin\controllers';

    public function init()
    {
    	// $this->layoutPath = Yii::getPathOfAlias('admin.views.layouts');
        parent::init();

        // custom initialization code goes here
    }
}
