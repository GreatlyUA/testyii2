<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\module\admin\models\News;

use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
	
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            return $this->redirect('../admin/news');
            
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    
    public function actionNews()
    {
    	$slug = Yii::$app->getRequest()->getQueryParam('slug');
    	$slug = str_replace(".html", "", $slug);
    	
    	if($slug)
    	{
    		$model = News::find()->where(['slug' => $slug])->one();
			return $this->render('newsshow', ['model' => $model]);
    	}
    	/*
    	else if(Yii::$app->getRequest()->getQueryParam('id'))
    	{
    		$model = News::findOne($app->getRequest()->getQueryParam('id'));
			return $this->render('newsshow', ['model' => $model]);
    	}
    	*/
    	else 
    	{
	    	$newsQuery = News::find();
			$DataProvider = new ActiveDataProvider([
	            'query' => $newsQuery,
	            'pagination' => [
	                'pageSize' => 5,
	            ],
	        ]);
	    	
	        return $this->render('news', ['DataProvider' => $DataProvider,]);
    	}
    }
   
}
