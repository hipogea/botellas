<?php

namespace frontend\controllers\masters;

use Yii;
use common\models\masters\Contactos;
use common\models\masters\Clipro;
use common\models\masters\ContactosSearch;
use common\helpers\h;
use common\controllers\base\baseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ContactosController implements the CRUD actions for Contactos model.
 */
class ContactosController extends baseController
{
    public $nameSpaces=['common\models\masters'];
    
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
     * Lists all Contactos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contactos model.
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
     * Creates a new Contactos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = new Contactos();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
      
        $vendorsForCombo=ArrayHelper::map(Clipro::find()->all(),'codpro','despro');
       // $vendorsForCombo=[];
        //var_dump($vendorsForCombo);die();
        return $this->render('create', [
            'model' => $model,'id'=>1,
            'vendorsForCombo'=>$vendorsForCombo,
        ]);
    }

    /**
     * Updates an existing Contactos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Contactos model.
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

    /**
     * Finds the Contactos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contactos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contactos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    /*
     * Esta function es una funcin general que devuelve datos 
     * de una peticion Ajax Para los widgets o combos que usan
     * la librería Select2 
     * @searchTerm: EL témino a buscar en la sentencia Like
     * @model: El nombre del modelo a buscar 
     * @firstField: El nombre del primer campo o camo clave del combo 
     * @secondField: El nombre del segundo campo
     */
    public function actionDatos(){
        if(h::request()->isAjax){
         //VAR_DUMP(h::request()->post('searchTerm'));DIE();
            //h::response()->format = \yii\web\Response::FORMAT_JSON;
         $filter= h::request()->post('searchTerm');
         $modelo= h::request()->post('model');
         // VAR_DUMP($modelo);
         $firstField=h::request()->post('firstField');
         $secondField=h::request()->post('secondField');
         $modelo=$this->getNamespace($modelo);
         if(is_null($filter) or empty($filter) or trim($filter)=="") 
              $resultados=[];
           else{
               //VAR_DUMP($modelo);die();
             $resultados= $modelo::find()->select([$firstField." as id",$secondField.' as text'])->where(['like',$secondField,$filter])->asArray()->all();
         
            
         }
         
           echo  \yii\helpers\Json::encode($resultados);
           //ECHO \yii\helpers\Json::encode([['id'=>'001','text'=>'PRIMERO'],['id'=>'002','text'=>'SEGUNDO']]);
        }
    }
}
