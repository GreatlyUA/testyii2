<?php

namespace app\module\admin\controllers;

use Yii;
use app\module\admin\models\News;
use app\module\admin\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;
use yii\imagine\Image;
use yii\db\ActiveRecord;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
	
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        if ($model->load(Yii::$app->request->post())) {
        	
        	
        	$model->save();
        	$last = $model->getPrimaryKey();
        	
        	$file = UploadedFile::getInstance($model, 'file');
            if ($file && $file->tempName) {
            	
                $model->file = $file;
                if ($model->validate(['file'])) {
                	
                $dir = Yii::getAlias('uploads/News/');
                $fileName = 'news_image_'.$last.'.jpeg';
                $model->file->saveAs($dir . $fileName);
                $model->file = $fileName; // без этого ошибка
                Image::thumbnail($dir . $fileName, 240, 180)->save(Yii::getAlias($dir .'thumbs/'. $fileName), ['quality' => 80]);
			    
				}
			
            }
           
            return $this->redirect(['index']);
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

      
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			
			$dir = Yii::getAlias('uploads/News/');
		    $fileName = 'news_image_'.$id.'.jpeg';
			
			if($model->del_img) {
			    if(file_exists($dir.$fileName)) {
					unlink($dir.$fileName);
					unlink($dir.'thumbs/'.$fileName);
				}
			}	
			
				$file = UploadedFile::getInstance($model, 'file');
								
				
	            if ($file && $file->tempName) {
	                $model->file = $file;
		                if ($model->validate(['file'])) {
					    
		                $model->file->saveAs($dir . $fileName);
		                $model->file = $fileName; // без этого ошибка
		                Image::thumbnail($dir . $fileName, 240, 180)->save(Yii::getAlias($dir .'thumbs/'. $fileName), ['quality' => 80]);
					}
				
            	}
												
            return $this->redirect(['index', 'id' => $model->id]);
            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		if(file_exists('/uploads/News/news_image_'.$id.'.jpeg')) {
			unlink('/uploads/News/news_image_'.$id.'.jpeg');
			unlink('/uploads/News/thumbnail/news_image_'.$id.'.jpeg');
		}	
			
        return $this->redirect(['index']);
    }

    public function actionStatus($id)
    {
    	$model = $this->findModel($id);
    	if($model->status == 0) $model->status = 1; else $model->status = 0;
    	$model->update();
    	return $this->redirect(['index']);
    }
    
    public function actionInhome($id)
    {
    	$model = $this->findModel($id);
    	if($model->in_home == 0) $model->in_home = 1; else $model->in_home = 0;
    	$model->update();
    	return $this->redirect(['index']);
    }
    
    
    
    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
