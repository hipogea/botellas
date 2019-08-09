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
use common\helpers\timeHelper;
use common\helpers\h;
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
    
    public $vTime;

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
        $verdadero=(h::request()->get('verdadero')=='1')?true:false; //Verdadero=true , ya no es una simulacion
        
        $interrumpido=false;
        $this->vTime=microtime(true);
      $cargamasiva=$his->findModel($id);//carga ell modelo cabecera
      $cargamasiva->verifyChilds();//Verificando las filas hijas de metadatos
      $carga=$cargamasiva->activeRecordLoad();   
      /*
       * AQUI VERIFICAMOS EL STATUS DEL REGISTRO A CARGAR
       * DEPENDIENDO DE SI ES MODON PRUEBA SIMUALCRO() O MODO CARGA
       * 
       */
      $this->validateStatus($carga->status, $verdadero);
      
      $datos=$carga->dataToImport(); //todo el array de datos para procesar, siempre empezara desde current_linea para adelante 
       $carga->verifyFirstRow(); //Verifica la primera fila valida del archivo csv, esto quiere decir que no neesarimente sera la primer linea 
        
       $model=$cargamasiva->modelAsocc();//Devuelve el modelo asociado a la importacion
        $carga->flushLogCarga();//Borra cualquier huella anterior en el log de carga
        $filashijas=$cargamasiva->ChildsAsArray();
   $linea=1;
    foreach ($datos as $fila){      
        
      $model->setAttributes($cargamasiva->AttributesForModel($fila,$filashijas));
      $model->validate();  
      
      $carga->setAttributes([
                  'current_linea'=>$linea,
                   //'total_linea'=>$this->count($datos),
                   'status'=>$carga::STATUS_ABIERTO,
                  ]);
      if($verdadero)$model->save();
      if($model->hasErrors()){
          $carga->logCargaByLine($linea,$model->getErrors());
      }
      
      if(timeHelper::excedioDuracion(microtime(true)-$this->vTime)){
             // $carga->status=$carga::STATUS_ABIERTO;
              $carga->save();
              $interrumpido=!$interrumpido;
             break;
       }  
      $linea++;   
          
    }    
         $searchModel = new ImportLogCargamasivaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    //se interrumpio por falta de tiempo, se grabo el registro con status abierto porque falta 
    if($interrumpido){
        return $this->render('break',['model'=>$carga,'dataprovider'=>$dataprovider]);
    }else{
        ///SI  HAY ERRORES MANTENER EL STATUS ABIERTO PORQUE NO ESTA PROBADO OK
        if($carga->nerrores()>0){
            
        }else{ //Si no hay errores  CAMBIAR STATUS adecuado 
          $carga->status=($verdadero)?$carga::STATUS_CARGADO:$carga::STATUS_PROBADO; 
        }        
        $carga->save();
      //Mostar errores o nada  
   return $this->render('info',['dataprovider'=>$dataprovider]); 
    }
    
    
    }
    /*
     *Solo pasa si se cumplen verdadero(carga)- probado  y  falso(prueba) - abierto
     */
     private function validateStatus($status,$verdadero){
         $mensaje='';
            
         if(ImportCargamasivaUser::STATUS_ABIERTO && $verdadero){
              $mensaje='No se puede efectuar la carga; el registro se encuentra abierto, pruebe primero para verificar errores';
         }
         if((ImportCargamasivaUser::STATUS_CARGADO && $verdadero)  or (ImportCargamasivaUser::STATUS_CARGADO && !$verdadero)){
             $mensaje='El registro de carga ya se ejecutó';
         }
         if(ImportCargamasivaUser::STATUS_PROBADO && !$verdadero){
              $mensaje='El registro de carga ya está probado y listo para cargarse';
         }
        if(strlen($mensaje)>0) $this->error ($mensaje);
         
    }
    
    private function error($mensaje){
        throw new \yii\base\Exception(Yii::t('import.errors',$mensaje));
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
      
      
      
   

