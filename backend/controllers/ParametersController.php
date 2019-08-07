<?php

namespace backend\controllers;

use Yii;
use common\controllers\base\baseController;
use common\models\masters\Centrosparametros;
use common\models\config\Parametros;
use common\models\config\ParametrosSearch;
use common\models\config\Parametrosdocu;
use common\models\config\ParametrosdocuSearch;
use common\models\masters\CentrosparametrosSearch;
use yii\web\Controller;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\h;
 use imanilchaudhari\CurrencyConverter\CurrencyConverter;
/**
 * ParametersController implements the CRUD actions for Centrosparametros model.
 */
class ParametersController extends baseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    
    
    
    /**
     * Lists all Centrosparametros models.
     * @return mixed
     */
    public function actionIndex()
    {
     
        
     
//var_dump(yii::$app->paramsGen->getP('10004','1203','104'));die();@
        //echo Parametros::findOne('10000')->getGeneralFormat('y.myyy.d','date',false);die();
        
        
        $searchModel = new CentrosparametrosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Centrosparametros model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Centrosparametros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Centrosparametros();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Centrosparametros model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
     
        $model = $this->findModel($id);
        //var_dump($model->hasChilds());die();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Centrosparametros model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
     public function actionDeletemaster($id)
    {
        
        
        Parametros::findOne($id);

        return $this->redirect(['index']);
    }
    
    
    

    /**
     * Finds the Centrosparametros model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Centrosparametros the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Centrosparametros::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    protected function findModelparameter($id)
    {
        if (($model = Parametros::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    
    public function actionCreatemaster(){
        $model = new Parametros();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
             return $this->redirect(['indexmaster']);
           }else{
              
              }
        return $this->render('createmaster', [
            'model' => $model,
        ]); 
    }
    
     public function actionUpdatemaster($id)
    {
        $model = $this->findModelparameter($id);
     // var_dump($model->scenarios());die();
      // var_dump($model->rules());die();
       if ($model->load(Yii::$app->request->post()) && $model->save()) {
          // $model->validate();
           // print_r($model->getErrors());die();
                   // print_r($model->attributes);die();    
               return $this->redirect(['indexmaster']);
            
             
           }else{
              
        }
      
        return $this->render('updatemaster', [
            'model' => $model,
        ]);
    }
    
    
    
     public function actionIndexmaster()
    {
       /* $modelito=Parametros::findOne('10000');
        var_dump($modelito->isBlockedField('codparam'));
        var_dump($modelito->activo);die();*/
    
         $searchModel = new ParametrosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexmaster', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    public function actionCreateparamdocu(){
        $model = new Parametrosdocu();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           return $this->redirect(['indexparamdocu']);
         
        }else{
            
        }
        return $this->render('createparamdocu', [
            'model' => $model,
        ]); 
    }
    
     public function actionIndexparamdocu(){
         $searchModel = new ParametrosdocuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexmasterdocu', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionDeletemodel(){
        if(h::request()->isAjax){
           $id= h::request()->post('id');
           $clase=str_replace('@','\\',h::request()->post('modelito'));
           //var_dump($clase);die();
           $datos=$this->deleteModel($id, $clase);
           h::response()->format = \yii\web\Response::FORMAT_JSON;
           return $datos;
        }
    }
    
}
