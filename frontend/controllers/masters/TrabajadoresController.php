<?php

namespace frontend\controllers\masters;

use Yii;
use common\models\masters\Trabajadores;
use common\models\config\Configuracion;
use common\models\masters\TrabajadoresSearch;

use common\models\base\modelBase;
use common\helpers\h;
use yii\web\Controller;
use yii\db\Migration;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use DateTime;
/**
 * TrabajadoresController implements the CRUD actions for Trabajadores model.
 */
class TrabajadoresController extends Controller
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
     * Lists all Trabajadores models.
     * @return mixed
     */
    public function actionIndex()
    { 
        echo h::user()->identity->tableName();die();
        /*$limon=new \common\models\Profile;
        echo $limon->persona::className();die();*/

//var_dump(\Carbon\Carbon::createFromFormat('d/m/Y','15/08/2019'));         die();
       // var_dump(Trabajadores::find()->where(['codigotra'=>'70w03'])->one());die();
        //echo \common\models\masters\Centros::find()->where(true)->one()->codcen;die();
      // print_r(\common\helpers\ComboHelper::getCboDepartamentos());die();
        //$modelo=new Configuracion();
      //print_r($modelo->rules());die();
        $searchModel = new TrabajadoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
if (Yii::$app->request->isAjax){
   return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); 
}else{
   return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); 
}
        
    }

    /**
     * Displays a single Trabajadores model.
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
     * Creates a new Trabajadores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Trabajadores();
        
       
       // $chema = new Migration();
        //var_dump($chema->getDb()->getSchema()->getTableSchema($model->tableName(), true));
       //die();
//Yii::$app->formatter->locale = 'es_PE';        
       /*echo get_class( DateTime::createFromFormat('yyyy/mm/dd','2018/11/23'))."<br>";
       echo get_class( DateTime::createFromFormat('Y-m-d','2018-11-28'))."<br>";
        die();
        echo Yii::$app->formatter->asRelativeTime(time()-23242554,time())." <br>";
        echo Yii::$app->formatter->asDuration(time())." <br>";
        echo Yii::$app->formatter->asDate(time(),'php:d-m-Y')." <br>";
        echo Yii::$app->formatter->asDate('23/04/2017','short')." <br>";
        echo Yii::$app->formatter->asDate('23-04-2017','long')." <br>";
        echo Yii::$app->formatter->asDate('23-04-2017','full')." <br>";*/
        
       
       /*echo Yii::$app->formatter->asDate('23-04-2017','php:y-M-d')." <br>";
        echo Yii::$app->formatter->asDate('23-04-2017','php:d-m-Y')." <br>";die();
        */
        
        
        /*$objetofecha=DateTime::createFromFormat(
                                                'Y-m-d',
                                                '2015-02-24'
                                        );
        /* var_dump(
                 $objectofecha
                 ); die();
            */     
                 
                 
        //var_dump(Yii::$app->formatter->asDate($objetofecha,'Y-m-d')); die();
        
        
        
        //$model->cumple='1974-04-28';
        //$model->fecingreso='2012-10-01';
        //$model->prepareTimeFields(true);
       // echo  " cumple ".$model->cumple."<br>";
       // echo  " fec ingreso  ".$model->fecingreso."<br>"; die();
        
        //echo yii::$app->settings->get('tables', 'sizeDnis');die();
        //echo $model->gsetting('tables', 'sizeDnis');
        //$model->gsetting('timeBD', 'date');
        //die();

        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($model);
        }
        
        
        
        if ($model->load(h::request()->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->codigotra]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Trabajadores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

         if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($model);
        }
        
        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           return $this->redirect(['view', 'id' => $model->codigotra]);
        }

        
        
        return $this->render('update', [
          'model'=>$model
        ]);
    }

    /**
     * Deletes an existing Trabajadores model.
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
     * Finds the Trabajadores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Trabajadores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Trabajadores::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('control.errors', 'The requested page does not exist.'));
    }
}
