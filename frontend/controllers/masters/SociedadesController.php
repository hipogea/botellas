<?php

namespace frontend\controllers\masters;

use Yii;
use common\models\masters\Sociedades;
use common\models\masters\SociedadesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SociedadesController implements the CRUD actions for Sociedades model.
 */
class SociedadesController extends Controller
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
     * Lists all Sociedades models.
     * @return mixed
     */
    public function actionIndex()
    {
      
 // VAR_DUMP(yii::getalias('@app/views')); die();
 //VAR_DUMP(Yii::$app->user->isGuest);DIE();
                /*VAR_DUMP(Yii::$app->user->identity->username);

        VAR_DUMP(Yii::$app->user->isGuest);
        (Yii::$app->user->Id);die();*/
        $searchModel = new SociedadesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sociedades model.
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
     * Creates a new Sociedades model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sociedades();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->socio]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Sociedades model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        
          $tran=$model->getDb()->beginTransaction();
        if ($model->load(Yii::$app->request->post())) {
           if( $model->save()){
                $tran->commit();
                return $this->redirect(['view', 'id' => $model->socio]);
           
           }else{
               $tran->rollBack();
           }
        }

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->socio]);
        }*/

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sociedades model.
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
     * Finds the Sociedades model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Sociedades the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sociedades::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('control.errors', 'The requested page does not exist.'));
    }
}
