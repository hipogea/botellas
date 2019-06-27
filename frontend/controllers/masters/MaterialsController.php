<?php

namespace frontend\controllers\masters;

use Yii;
use common\models\masters\Maestrocompo;
use common\models\masters\MaestrocompoSearch;
use common\models\masters\ConversionesSearch;
use common\models\masters\Conversiones;
use common\controllers\base\baseController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MaterialsController implements the CRUD actions for Maestrocompo model.
 */
class MaterialsController extends baseController
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
     * Lists all Maestrocompo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MaestrocompoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Maestrocompo model.
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
     * Creates a new Maestrocompo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //\common\helpers\h::settings()->invalidateCache();
      //var_dump(\common\helpers\h::settings()->get('tables','sizecodigomaterial'));die();
        $model = new Maestrocompo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }else{
           // print_r($model->getErrors());die();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Maestrocompo model.
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

        
        
         $searchModel = New ConversionesSearch();
       $probConversiones= $searchModel->searchByMaterial($model->codart);

        
        return $this->render('update', [
            'model' => $model,
            'probConversiones'=>$probConversiones
        ]);
    }

    /**
     * Deletes an existing Maestrocompo model.
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
     * Finds the Maestrocompo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Maestrocompo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Maestrocompo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('base.names', 'The requested page does not exist.'));
    }
    
    public function actionCreaconversion($id){
          $this->layout = "install";
        //$modelReporte = $this->findModel($id);
        $model = new Conversiones();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //echo \yii\helpers\Html::script("$('#createCompany').modal('hide'); window.parent.$.pjax({container: '#grilla-contactos'})");
            $this->closeModal('modal-conversiones','holas');
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_conversion', [
                        'model' => $model,
                        'codigo' => $id,
                            //'vendorsForCombo'=>  $vendorsForCombo,
                            //'aditionalParams'=>$aditionalParams
            ]);
        } else {
            
            return $this->render('_detalle', [
                        'model' => $model,
                        //'vendorsForCombo' => $vendorsForCombo,
            ]);
        }
    }
}
