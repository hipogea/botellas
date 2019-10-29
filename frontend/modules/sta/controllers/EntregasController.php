<?php

namespace frontend\modules\sta\controllers;

use Yii;
use frontend\modules\sta\models\Entregas;
use frontend\modules\sta\models\EntregasSearch;

use frontend\controllers\base\baseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use frontend\modules\import\models\ImportCargamasiva as CargaMasiva;
use frontend\modules\import\models\ImportCargamasivadetSearch;
use frontend\modules\import\models\ImportCargamasivaUser;
use frontend\modules\import\models\ImportCargamasivaUserSearch;
use common\helpers\h;

/**
 * EntregasController implements the CRUD actions for Entregas model.
 */
class EntregasController extends baseController
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
     * Lists all Entregas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EntregasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Entregas model.
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
     * Creates a new Entregas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Entregas();

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }ELSE{
           // PRINT_R($model->getErrors());DIE();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Entregas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
     //var_dump(utf8_encode('holÁ'));die();
        
        /* var_dump(microtime(true),\common\helpers\timeHelper::getMaxTimeExecute(),
               \common\helpers\timeHelper::excedioDuracion(151)
               );die();*/
        
        /*$modelito=new \frontend\modules\sta\models\Periodos();
        $modelito->setAttributes([
            'codperiodo'=>'2004II',
            'periodo'=>'PERODO 2323',
            'activa'=>'0'
        ]);
        $modelito->validate();
        print_r($modelito->getErrors());die();*/
        
        $model = $this->findModel($id);
        $filter=($model->cargamasiva_id >0)?$model->cargamasiva_id:-1; //Si no tiene asociado la carga masiva no filtrar nada
      // var_dump($filter);die();
        
         $searchModelFields = new ImportCargamasivadetSearch();
        $dataProviderFields = $searchModelFields->searchById($filter);
        //var_dump($dataProviderFields->getTotalCount());die();
        $searchModel = new ImportCargamasivaUserSearch();
        $dataProvider = $searchModel->searchById($filter);
        $modelCarga= CargaMasiva::findOne(['id'=>$model->cargamasiva_id]);
        
        
        //var_dump($model->attributes,$model->getAttributes(),$model->safeAttributes());die();
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }
        //print_r(\common\helpers\FileHelper::getModelsFromModules('sta'));die();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelCarga'=> $modelCarga,
            'dataProviderFields'=>$dataProviderFields,
        
        ]);
    }

    /**
     * Deletes an existing Entregas model.
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
     * Finds the Entregas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Entregas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Entregas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('sta.labels', 'The requested page does not exist.'));
    }
    
    /*
     * Crear un registro de archivo de carga
     * en el módulo de importaciones
     */
   public function actionAjaxCreateUpload(){
       $datos=[];
     
        $id=h::request()->get('id');
        $entrega= $this->findModel($id);
   if($entrega->hasAttachments()){
     if(!($entrega->cargamasiva_id >0 )){ //si no tiene carga masiva asociada aun 
                    $model=New CargaMasiva();
                         $model->setAttributes([
                                    'user_id'=>h::userId(),
                                     'insercion'=>'1',
                                    'escenario'=>$entrega->escenario,
                                        'format'=>'csv',
                                    //'tienecabecera'=>'1',
                                                 'descripcion'=>$entrega->descripcion,
                                        'modelo'=>$entrega->modelo,
                                        ]);
                                if($model->save())
                                $model->refresh();
          
     }else{
         $model= CargaMasiva::findOne($entrega->cargamasiva_id);
     }
     
     $entrega->cargamasiva_id=$model->id; //Enlazando entregas con Carga masiva   
         $entrega->cargamasiva_id=$model->id; //Enlazando entregas con Carga masiva
            $entrega->save();
         $attributes=[
            'cargamasiva_id'=>$model->id,
             'descripcion'=>'CARGA MASIVA-'. uniqid(),
            'activo'=>'10',
             'tienecabecera'=>$entrega->tienecabecera,
             'user_id'=>h::userId(),
            ];        
        if(ImportCargamasivaUser::firstOrCreateStatic($attributes,'minimo')){
           // $carguita=$model->importCargamasivaUser[0];
            $carguita= ImportCargamasivaUser::lastRecordCreated();
        $mensaje= $carguita->
            attachFromPath($entrega->files[0]->getPath());
            $carguita->total_linea=$carguita->csv->numberLinesToImport();
            $carguita->save();
            //$datos['success']=$mensaje."<br>".yii::t('sta.messages','Se creó el detalla de carga exitosamente');
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;  
       return $this->renderAjax('carga',[
           'model'=>$carguita,
           'identrega'=>$entrega->id,
               ]);
   } else{
        
    }
   
   }
   /*
    * Encuentra el primer aregistro de importacion 
    * en la tabla cargamasiva 
    */
   public function actionResolveUpload($id){
       $model=$this->findModel($id);
       $carga= CargaMasiva::find()->where(['modelo'=>$model->modelo])->
               orderBy(['id' => SORT_DESC])->one();
       if(is_null($carga))
           throw new NotFoundHttpException(Yii::t('import.errors', 'El registro de carga no existe.'));
          return $this->redirect([
                  '/import/importacion/update',
                'id' => $carga->id]);
       }
   
}
