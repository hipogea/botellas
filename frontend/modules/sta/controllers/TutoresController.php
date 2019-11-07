<?php

namespace frontend\modules\sta\controllers;

use Yii;
use frontend\modules\sta\models\Talleres;
use frontend\modules\sta\models\Tallerpsico;
use frontend\modules\sta\models\RangosSearch;
use frontend\modules\sta\models\TalleresSearch;
use frontend\modules\sta\models\VwAlutaller;
use frontend\modules\sta\models\VwAlutallerSearch;
use frontend\modules\sta\models\VwAluriesgoSearch;
use frontend\modules\sta\models\TallerpsicoSearch;
use frontend\modules\sta\models\StaTestTalleres;
use frontend\modules\sta\models\VwStaTutoresSearch;
use frontend\modules\sta\models\Rangos;
use frontend\modules\sta\models\Test;
use frontend\controllers\base\baseController;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use common\helpers\h;
USE common\widgets\buttonsubmitwidget\buttonSubmitWidget;

/**
 * ProgramasController implements the CRUD actions for Talleres model.
 */
class ProgramasController extends baseController
{
     public $nameSpaces = ['frontend\modules\sta\models'];
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
     * Lists all Talleres models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TalleresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Talleres model.
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
     * Creates a new Talleres model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Talleres();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Talleres model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        
        
        $model = $this->findModel($id);
        //yii::error('eNCONTOR MODELO');
//print_r($model->studentsInRiskForThis()); die();
         $searchStaff = new TallerpsicoSearch();
        $dataProviderStaff = $searchStaff->SearchByTaller($id);
        
        $searchRangos = new RangosSearch();
        $dataProviderRangos = $searchRangos->SearchByTaller($id);

         $searchAlumnos = new VwAlutallerSearch();
        $dataProviderAlumnos = $searchAlumnos->searchByFacultad(
                h::request()->queryParams,$model->codfac);
//yii::error('que pasa');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
           'dataProviderStaff'=>$dataProviderStaff,
             'dataProviderRangos'=> $dataProviderRangos,
           // 'searchStaff' =>$searchStaff,
            'dataProviderAlumnos'=>$dataProviderAlumnos,
            'searchAlumnos' => $searchAlumnos,
        ]);
    }

    /**
     * Deletes an existing Talleres model.
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
     * Finds the Talleres model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Talleres the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Talleres::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('sta.labels', 'The requested page does not exist.'));
    }
    
    public function actionRefrescaAlumnos(){
        if(h::request()->isAjax){
            $model=$this->findModel(h::request()->post('id'));
            $carga=$model->loadStudents();
             h::response()->format = Response::FORMAT_JSON;
             if($carga['total']==$carga['contador']){
             $datos['success']=yii::t('sta.messages',
                     'Se insertaron {insertados} Registros ',
                     ['insertados'=>$carga['contador']]);
             }else{
               if($carga['contador']==0){//Si no se inserto nada
                $datos['warning']=yii::t('sta.messages',
                     'No hay alumnos nuevos que insertar'
                     );     
               }else{
               $datos['warning']=yii::t('sta.messages',
                     'Se insertaron {insertados} Registros de {totales}',
                     ['insertados'=>$carga['contador'],'totales'=>$carga['total']]);  
             }
             }
             return $datos;
        }
    }
    
    
    public function actionAluriesgo(){
         $searchModel = new VwAluriesgoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('riesgo', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
   
    public function actionAgregaPsico($id){        
         $this->layout = "install";
        $modelprograma = $this->findModel($id);
        $varios=$modelprograma->freeStudents();
       
       $modelprograma->sincronizeCant();
        $cantidadLibres=count($varios);unset($varios);
         yii::error('estudiantes libres en '.$cantidadLibres,__METHOD__);
       $model=New Tallerpsico();
       $model->talleres_id=$id;
       
       $datos=[];
        if(h::request()->isPost){
            $model->load(h::request()->post());
             h::response()->format = \yii\web\Response::FORMAT_JSON;
            $datos=\yii\widgets\ActiveForm::validate($model);
            if(count($datos)>0){
               return ['success'=>2,'msg'=>$datos];  
            }else{
                $model->save();
                $model->assignStudentsByRandom();
                  return ['success'=>1,'id'=>$model->talleres_id];
            }
        }else{
           return $this->renderAjax('_psico', [
                        'model' => $model,
                        'id' => $id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
       
       /*if(h::request()->isAjax && h::request()->isPost){
           yii::error('esqajax');
           h::response()->format = \yii\web\Response::FORMAT_JSON;
            yii::error('ya coloco eñ foramt x');
           $datos=\yii\widgets\ActiveForm::validate($model);
            yii::error('ya asigno los datos ');
       } 
       if( empty($datos) && $model->save() && h::request()->isPost){
           yii::error('model sving ');
           return ['success'=>1,'id'=>$model->talleres_id];
       }elseif(h::request()->isPost){
           yii::error('no paso nada  ');
          return ['success'=>2,'msg'=>$datos]; 
       }else{
           yii::error('Renderizado ');
           return $this->renderAjax('_psico', [
                        'model' => $model,
                        'id' => $id,
                        'cantidadLibres'=>$cantidadLibres,
          
            ]); 
       }
       
       
      /* if(h::request()->isPost){
           if(h::request()->isAjax &&  $model->load(Yii::$app->request->post())){
               h::response()->format = \yii\web\Response::FORMAT_JSON;
              return \yii\widgets\ActiveForm::validate($model); 
           }
            
            $this->closeModal('buscarvalor', 'grilla-staff');
       }else{
          return $this->renderAjax('_psico', [
                        'model' => $model,
                        'id' => $id,
                        'cantidadLibres'=>$cantidadLibres,
          
            ]); 
       }*/
      /* if(h::request()->isAjax && $model->load(h::request()->post())){            
            if ($model->save()) {
                   $model->assignStudentsByRandom();
                 yii::error('ha grabado',__METHOD__);
                 $this->closeModal('buscarvalor', 'grilla-staff');
              
              yii::error('intento cerrar',__METHOD__);
             
                       
                        } else{
                            h::response()->format = \yii\web\Response::FORMAT_JSON;
                       return \yii\widgets\ActiveForm::validate($model);
                        }
         
        }       
      return $this->renderAjax('_psico', [
                        'model' => $model,
                        'id' => $id,
                        'cantidadLibres'=>$cantidadLibres,
          
            ]); 
      */
    }
    
    
   public function actionEditTutor(){
       if ($this->is_editable())
            return $this->editField();
   }
   /*
    * Desafilia el tutor
    * y devuelve los mensajes acecidos
    */
     public function actionAjaxDetachPsico($id){
         if(h::request()->isAjax){
             
             
             
               h::response()->format = \yii\web\Response::FORMAT_JSON;
           
             $modelo= Tallerpsico::findOne($id);
            
              $modelo->dettachTutor();
              return $modelo->messages();
         }
       
    }
    
    public function actionAgregaTest(){
       if(h::request()->isAjax){
           h::response()->format=\yii\web\Response::FORMAT_JSON;
           $modelTaller=$this->findModel(h::request()->post('id'));
           $codigo=h::request()->post('codtest');
           $model=Test::findOne($codigo);
           if(!is_null($model)){
               
               
               if(StaTestTalleres::firstOrCreateStatic([
                   'taller_id'=>$modelTaller->id,
                   'codtest'=>$codigo,
                  // 'peso'=>1,
                  // 'obligatorio'=>'0',
                       ])){
                  return ['success'=>yii::t('sta.errors','Se ha agregado el Test Satisfactoriamente')];     
                 
               }else{
              return ['error'=>yii::t('sta.errors','Hubo un error al grabar el registro, posiblemente este test ya está agregado')];     
               }
           }else{
               return ['error'=>yii::t('sta.errors','No se encontró ningún registro para el código {}',['codigo'=>$codigo])];
           }
       }
    }
 
 public function actionTutores(){
     
     
     
      $searchModel = new VwStaTutoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('_tutores', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
 }   
   

  public function actionEditRango($id){
     $this->layout = "install";
        $model = \frontend\modules\sta\models\Rangos::findOne($id);
        $datos=[];
        if(is_null($model)){
            //Si es error buttonSubmitWidget::OP_TERCERA
            //lanza un NOTY msg de error
            return ['success'=>buttonSubmitWidget::OP_TERCERA,'msg'=>$datos];
        }
        
      
        if(h::request()->isPost){
            $model->setScenario(Rangos::SCENARIO_HORAS);
            $model->load(h::request()->post());
             h::response()->format = \yii\web\Response::FORMAT_JSON;
            $datos=\yii\widgets\ActiveForm::validate($model);
            if(count($datos)>0){
               return ['success'=>buttonSubmitWidget::OP_SEGUNDA,'msg'=>$datos];  
            }else{
                $model->save();
                
                  return ['success'=>buttonSubmitWidget::OP_PRIMERA,'id'=>$model->talleres_id];
            }
        }else{
            //var_dump($model->attributes);die();
           return $this->renderAjax('_rangos', [
                        'model' => $model,
                        'id' => $id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
       
  } 


}
