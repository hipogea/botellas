<?php

namespace frontend\modules\sta\controllers;

use Yii;
use frontend\modules\sta\models\Talleres;
use frontend\modules\sta\models\Tallerpsico;
use frontend\modules\sta\models\TalleresSearch;
use frontend\modules\sta\models\VwAlutaller;
use frontend\modules\sta\models\VwAlutallerSearch;
use frontend\modules\sta\models\VwAluriesgoSearch;
use frontend\modules\sta\models\TallerpsicoSearch;
use frontend\controllers\base\baseController;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use common\helpers\h;

/**
 * ProgramasController implements the CRUD actions for Talleres model.
 */
class ProgramasController extends baseController
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
        yii::error('eNCONTOR MODELO');
//print_r($model->studentsInRiskForThis()); die();
         $searchStaff = new TallerpsicoSearch();
        $dataProviderStaff = $searchStaff->SearchByTaller($id);

         $searchAlumnos = new VwAlutallerSearch();
        $dataProviderAlumnos = $searchAlumnos->searchByFacultad(
                h::request()->queryParams,$model->codfac);
yii::error('que pasa');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
           'dataProviderStaff'=>$dataProviderStaff,
            'searchStaff' =>$searchStaff,
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
        $modelclipro = $this->findModel($id);
       $model=New Tallerpsico();
       $model->talleres_id=$id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //echo \yii\helpers\Html::script("$('#createCompany').modal('hide'); window.parent.$.pjax({container: '#grilla-contactos'})");
            $this->closeModal('buscarvalor', 'grilla-staff');
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_psico', [
                        'model' => $model,
                        'id' => $id,
                            //'vendorsForCombo'=>  $vendorsForCombo,
                            //'aditionalParams'=>$aditionalParams
            ]);
        }
        /*ELSE{
            PRINT_R($model->getErrors());DIE();
        }*/
    }
}
