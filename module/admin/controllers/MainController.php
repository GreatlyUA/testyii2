<?php

namespace app\module\admin\controllers;

use Yii;
use yii\web\Controller;
use app\module\admin\models\Main;


class MainController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
