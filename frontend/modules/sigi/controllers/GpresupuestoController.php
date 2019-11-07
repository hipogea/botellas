<?php

namespace frontend\modules\sigi\controllers;

use Yii;
use frontend\modules\sigi\models\SigiGrupoPresupuesto;
use frontend\modules\sigi\models\SigiGrupoPresupuestoSearch;
use frontend\controllers\base\baseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\h;
use yii\helpers\Url;
use yii\web\Response;
use yii\widgets\ActiveForm;
use common\widgets\buttonsubmitwidget\buttonSubmitWidget;
/**
 * GpresupuestoController implements the CRUD actions for SigiGrupoPresupuesto model.
 */
class GpresupuestoController extends baseController
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
     * Lists all SigiGrupoPresupuesto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SigiGrupoPresupuestoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SigiGrupoPresupuesto model.
     * @param string $id
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
     * Creates a new SigiGrupoPresupuesto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SigiGrupoPresupuesto();
        
        $errores=[];
        IF(h::request()->isPost){
             //yii::error('Es Post, cargando post ',__METHOD__);
            $model->load(h::request()->post());
           // yii::error('los atributos  ',__METHOD__);
           // yii::error($model->attributes,__METHOD__);
            if(h::request()->isAjax){
                // yii::error('ES POST Y es ajax ahora cambiando response ',__METHOD__);
               h::response()->format = Response::FORMAT_JSON;
               $errores= ActiveForm::validate($model);
               if(count($errores)>0){
                 //  yii::error('hay errrores ',__METHOD__);
                   return ['success'=>buttonSubmitWidget::OP_SEGUNDA,'msg'=>$errores];
               }else{
                    //yii::error('NO hay errrores ',__METHOD__);
                   $model->save();
                   return ['success'=>buttonSubmitWidget::OP_PRIMERA,'id'=>$model->codigo];
               }
            }else{
                // yii::error('ES POST Y no ES AJAX  ',__METHOD__);
                $model->save();
                return $this->redirect(['view', 'id' => $model->codigo]);
            }
            
        }else{
            //var_dump(h::request()->get('idModal'),h::request()->get('gridName'));die();
            if(h::request()->isAjax){
                $this->layout="install";
               return $this->renderAjax('_form',[
                   'model'=>$model,
                    'id'=>h::request()->get('id'),
                    'gridName'=>h::request()->get('gridName'),
                    'idModal'=>h::request()->get('idModal'),
                ]);
            }else{
               return $this->render('create', [
                    'model' => $model,
                ]);
            }
            
        }
        
        
       
    }

    /**
     * Updates an existing SigiGrupoPresupuesto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->codigo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SigiGrupoPresupuesto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SigiGrupoPresupuesto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SigiGrupoPresupuesto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SigiGrupoPresupuesto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('sigi.labels', 'The requested page does not exist.'));
    }
}
