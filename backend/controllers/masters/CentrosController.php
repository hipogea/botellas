<?php

namespace backend\controllers\masters;
use frontend\controllers\base\baseController;
use Yii;
use common\models\masters\Centros;
use common\models\masters\CentrosSearch;
use common\models\config\ParametroscentrosSearch;
use common\models\config\Parametroscentros;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
/**
 * CentrosController implements the CRUD actions for Centros model.
 */
class CentrosController extends baseController
{
    public $nameSpaces = ['common\models\masters','common\models\config'];
    
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
     * Lists all Centros models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $searchModel = new CentrosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Centros model.
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
     * Creates a new Centros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Centros();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
          }
        
        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->codcen]);
        }ELSE{
           // PRINT_R($model->getErrors());die();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Centros model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
//var_dump($model->rules());die();
         if ($this->is_editable())
            return $this->editField();
        
         
         if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
Yii::$app->response->format =
Response::FORMAT_JSON;
return ActiveForm::validate($model);
}
         
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->codcen]);
        }

        
        
        $searchModel = new ParametroscentrosSearch();
       $dataProvider = $searchModel->searchByCenter(
               Yii::$app->request->queryParams,
               $model->codcen               
               );

        return $this->render('update', [
            'model' => $model,
            'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
        
    }

    /**
     * Deletes an existing Centros model.
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
     * Finds the Centros model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Centros the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Centros::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
