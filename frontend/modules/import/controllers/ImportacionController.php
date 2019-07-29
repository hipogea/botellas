<?php

namespace frontend\modules\import\controllers;
/*Paquete de importacion */
/*use ruskid\csvimporter\CSVReader;
use ruskid\csvimporter\CSVImporter;
use ruskid\csvimporter\BaseUpdateStrategy;
use ruskid\csvimporter\BaseImportStrategy;
use ruskid\csvimporter\ARUpdateStrategy;
use ruskid\csvimporter\ARImportStrategy;*/
/*fin del paquetre de importacion*/

use Yii;
use frontend\modules\import\models\ImportCargamasiva;
use frontend\modules\import\models\ImportCargamasivaSearch;
use frontend\modules\import\models\ImportLogcargamasivaSearch;
use frontend\modules\import\models\ImportCargamasivadet;
use frontend\modules\import\models\ImportCargamasivadetSearch;
use frontend\modules\import\models\ImportCargamasivaUser;
use frontend\modules\import\models\ImportCargamasivaUserSearch;
//use frontend\modules\import\models\ImportLogcargamasivaSearch;
use common\controllers\base\baseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\h;

/**
 * ImportController implements the CRUD actions for ImportCargamasiva model.
 */
class ImportacionController extends baseController
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
     * Lists all ImportCargamasiva models.
     * @return mixed
     */
    public function actionIndex()
    {
       /// $importer = new CSVImporter;  die();
        $searchModel = new ImportCargamasivaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ImportCargamasiva model.
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
     * Creates a new ImportCargamasiva model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ImportCargamasiva();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }else{
            //print_r($model->getErrors());die();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ImportCargamasiva model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $searchModelFields = new ImportCargamasivadetSearch();
        $dataProviderFields = $searchModelFields->searchById($id);
            $searchModelLoads = new ImportCargamasivaUserSearch();
        $dataProviderLoads = $searchModelLoads->searchById($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'itemsFields'=> $dataProviderFields,
            'itemsLoads'=> $dataProviderLoads,
        ]);
    }

    /**
     * Deletes an existing ImportCargamasiva model.
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
     * Finds the ImportCargamasiva model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ImportCargamasiva the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ImportCargamasiva::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('import.labels', 'The requested page does not exist.'));
    }
    
    
    
    
    public function actionImportar($id){
        ///$namemodule=$this->module->id;
      $cargamasiva=$his->findModel($id);
      $cargamasiva->verifyChilds();
      $carga=$cargamasiva->activeRecordLoad();
      
      $datos=$carga->dataToImport(); 
      /*Verifica si las columnas coindicen */
       $carga->verifyFirstRow($datos[1]); //datos[1] porsiacaso datos[0] sea la cabecera y no una fila de dartos 
        
       $model=$cargamasiva->modelAsocc();
        $carga->flushLogCarga();
        $filashijas=$cargamasiva->childQuery()->orderBy(['orden'=>SORT_ASC])->asArray()->all();
   $linea=1;
    foreach ($datos as $fila){
      $model->setAttributes($cargamasiva->prepareAttributesToModel($fila,$filashijas));
      $model->validate();
      if($model->hasErrors()){
          $cargamasiva->logCargaByLine($linea);
      }
      $linea++;      
   }
   if($carga->nerrores()==0)
    return $this->redirect (\yii\helpers\Url::to(['importar-true','id'=>$id]));
   
    $searchModel = new ImportLogCargamasivaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

   return $this->render('info',['dataprovider'=>$dataprovider]);
      
    }
    
  public function actionImportarTrue($id){
      ///$namemodule=$this->module->id;
      $cargamasiva=$his->findModel($id); 
      
      /*Si no encuentra errores 
       * hay que hacerlo*/
      
     if($cargamasiva->nerrores()==0){
        $datos=$cargamasiva->dataToImport();
        $model=$cargamasiva->modelAsocc();
        $filashijas=$cargamasiva->childQuery()->orderBy(['orden'=>SORT_ASC])->asArray()->all();
   
            foreach ($datos as $fila){
                $model->setAttributes(prepareAttributesToModel($fila,$filashijas));
                $model->save();      
          
                } 
          }
      /*Borramos el archivo csv de carga*/
        $cargamasiva->deleteCsvFile();
   $searchModel = new ImportLogCargamasivaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('info',['dataprovider'=>$dataprovider]);
      
  }
  
  public function actionEscenarios(){
      /* Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $clave = $parents[0];
           $modelo=new $clave;
           $escenarios=array_keys($modelo->scenarios());
           foreach($escenarios as $clave=>$escenario){
          $out[]=['id'=>$escenario,'name'=>$escenario];
             }
           
            return ['output'=>$out, 'selected'=>''];
        }
    }
    return ['output'=>'', 'selected'=>''];*/
     if(h::request()->isAjax){
       $clase=h::request()->post('filtro'); 
       $clase=new $clase;
       $arr=array_keys($clase->scenarios());
     }
      
     return \yii\helpers\Html::renderSelectOptions(null,array_combine($arr,$arr));
}




       
       
}
      
      
      
   

