<?php

namespace backend\controllers\masters;

use Yii;
use common\models\masters\Documentos;
use common\models\masters\DocumentsSearch;
use common\models\config\ParametroscentrosdocuSearch;
use common\controllers\base\baseController;
use yii\web\Controller;
use yii\base\Model;
use common\helpers\h;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocumentsController implements the CRUD actions for Documentos model.
 */
class DocumentsController extends baseController
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
     * Lists all Documentos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Documentos model.
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
     * Creates a new Documentos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    // var_dump(\common\helpers\FileHelper::getModels());die();
        
       $this->flushSessionDetail();//limpia la variale de sesion detalle
        $model = new Documentos();
        //$pari=new \common\models\masters\Parametrosdocu();
       // $pari->obRelations();
       // $pari->fieldsLink();
       //var_dump($pari->fieldsLink());
       //var_dump($pari->obtenerForeignField('codocu'));
       //die();
       // $items=[new \common\models\masters\Parametrosdocu()];
        /* if(Yii::$app->request->isPost){
                $count = count(Yii::$app->request->post('Parametrosdocu', []));
                $items = [new \common\models\config\Parametrosdocu()];
                for($i = 1; $i < $count; $i++) {
                $items[] = new \common\models\config\Parametrosdocu();
                }*/
            /* foreach(Yii::$app->request->post('Parametrosdocu') as $index=>$valor){
              $items[]= new \common\models\masters\Parametrosdocu();
          }*/
         // var_dump(Yii::$app->request->post('Documentos'));echo "<br><br>";
         //var_dump(Yii::$app->request->post('Parametrosdocu',[]));
          /*var_dump(Model::loadMultiple($items, Yii::$app->request->post('Parametrosdocu'),''));
          var_dump(Model::validateMultiple($items));
          var_dump($model->load(Yii::$app->request->post('Documentos'),''));
          var_dump($model->validate());
          die();*/
          
       /*   if (
        Model::loadMultiple($items, Yii::$app->request->post('Parametrosdocu'),'') && 
        Model::validateMultiple($items) && $model->load(Yii::$app->request->post('Documentos'),'') &&
        $model->validate()){
        $model->save();foreach($items as $item){
            $item->save();
        }
        return $this->redirect(['view', 'id' => $model->codocu]);
         }
          
          
        }*/
       
   // $modelDetail=new Parametroscentrosdocu();
       /* $searchDetail = new ParametroscentrosdocuSearch();
       $dataProvider = $searchDetail->searchByDocu(
               Yii::$app->request->queryParams,
               '1000'
               );

        */
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->codocu]);
        }

        return $this->render('create', [
            'model' => $model,
           // 'searchModel' => $searchDetail,
                  //  'dataProvider' => $dataProvider,
        ]);
    }
    
    
     public function actionAdditem()
    {
       $modelDetail=new Parametrosdocu();
        $orden=$this->countDetail();
        $html = $this->renderPartial('item',           
           [ 'modelDetail'=>$modelDetail,
            'orden'=>$orden,
             'form'=>new \yii\widgets\ActiveForm(),
               
        ]);
        //con esto 
         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
       //solo retornar el array no es necsario el json::encode
        return 
               [
            'success' => true,
            'error'   => false,
            'data'    => [
            ],
            'message' => 'null',
            'html'    => $html,
        ]
               ;
        
    }

    /**
     * Updates an existing Documentos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->codocu]);
        }

        $searchDetail = new ParametroscentrosdocuSearch();
       $dataProvider = $searchDetail->searchByDocu(
               Yii::$app->request->queryParams,
               $model->codocu
               
               );

        
        
        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->codocu]);
        }*/

        return $this->render('update', [
            'model' => $model,
            'searchModel' => $searchDetail,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing Documentos model.
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
     * Finds the Documentos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Documentos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Documentos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    
    public function actionListado($q = null) {
    $query = new \yii\db\Query;
    
    $query->select('codparam,desparam')
        ->from('{{%parametros}}')
        ->where('desparam LIKE "%' . $q .'%"')
        ->orderBy('desparam');
    $command = $query->createCommand();
    $data = $command->queryAll();
    $out = [];
    foreach ($data as $d) {
        $out[] = ['value' => $d['codparam'].'--'.$d['desparam']];
    }
    echo \yii\helpers\Json::encode($out);
}


}
