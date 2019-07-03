<?php

namespace frontend\modules\bigitems\controllers;

use Yii;use DateTime;
use frontend\modules\bigitems\models\Docbotellas;
use frontend\modules\bigitems\models\Activos;
use common\helpers\h;
use frontend\modules\bigitems\models\viewsmodels\VwDocbotellasSearch;
use frontend\modules\bigitems\models\Detdocbotellas;
use common\controllers\base\baseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
/**
 * BottlesController implements the CRUD actions for Docbotellas model.
 */
class BottlesController extends baseController
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
     * Lists all Docbotellas models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        //echo get_class(Activos::find());die();
    
        
        
        $searchModel = new VwDocbotellasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Docbotellas model.
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
     * Creates a new Docbotellas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Docbotellas();

       // var_dump($model->codocu);die();
        
        /*$models = [new Item()];
        $request = Yii::$app->getRequest();
        if ($request->isPost && $request->post('ajax') !== null) {
            $data = Yii::$app->request->post('Item', []);
            foreach (array_keys($data) as $index) {
                $models[$index] = new Item();
            }
            Model::loadMultiple($models, Yii::$app->request->post());
            Yii::$app->response->format = Response::FORMAT_JSON;
            $result = ActiveForm::validateMultiple($models);
            return $result;
        }

        if (Model::loadMultiple($models, Yii::$app->request->post())) {
            // your magic
        }
        */
        
        
        
        
        
        
          $items=[new Detdocbotellas()];
          //$request = Yii::$app->getRequest();
         if(Yii::$app->request->isPost){
              $count = count(Yii::$app->request->post('Detdocbotellas', []));
              
              $items = [new Detdocbotellas()];
                        for($i = 1; $i < $count; $i++) {
                                $items[] = new Detdocbotellas();
               
                                }
                            
         if ( h::request()->isAjax &&
                  $model->load(Yii::$app->request->post('Docbotellas'),'')
                 //&&
                 //Model::loadMultiple($items, Yii::$app->request->post('Detdocbotellas'),'')
                 ) {
               //ECHO $count."<br>";
              
                
                     
                Model::loadMultiple($items, Yii::$app->request->post('Detdocbotellas'),'');
              /* ECHO count($items)."<br>";
               print_r($items[0]->attributes);
               echo "<br><br>";
               print_r($items[1]->attributes);
               die();*/
                h::response()->format = \yii\web\Response::FORMAT_JSON;
                 return array_merge(\yii\widgets\ActiveForm::validate($model),
                 \yii\widgets\ActiveForm::validateMultiple($items));
                
        }
            /* foreach(Yii::$app->request->post('Parametrosdocu') as $index=>$valor){
              $items[]= new \common\models\masters\Parametrosdocu();
          }*/
         // var_dump(Yii::$app->request->post('Documentos'));echo "<br><br>";
         //var_dump(Yii::$app->request->post('Parametrosdocu',[]));
          /*var_dump(Model::loadMultiple($items, Yii::$app->request->post('Detdocbotellas'),''));
          var_dump(Model::validateMultiple($items));
          var_dump($model->load(Yii::$app->request->post('Docbotellas'),''));
          var_dump($model->validate());
          $items[0]->validate();
          VAR_DUMP($items[0]->getErrors());
          
          die();*/
          //var_dump(Yii::$app->request->post());die();
        
        if ($model->load(Yii::$app->request->post('Docbotellas'),'') &&       
        Model::loadMultiple($items, Yii::$app->request->post('Detdocbotellas'),'')&&
         $model->validate()   ){
              $model->save();$model->refresh();
               $items=$this->linkeaCampos($model->id, $items);
              if(Model::validateMultiple($items)){
                  foreach($items as $item){
                        if($item->save()){
                           
                        }else{
                          
                        }
                           }
                    
                } else{
                    
                }
               
              }       
                  
               
              return $this->redirect(['index']);
       
     
         }
             
        
        
        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }else{
            print_r($model->attributes
                    );die();
        }*/
       for($i = 1; $i < 4; $i++) {
                                $items[] = new Detdocbotellas();
                            }
        return $this->render('create', [
            'model' => $model,'items'=>$items
        ]);
    }
    
    /**
     * Updates an existing Docbotellas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
         
        
        
         
        
        
        
        
        
        
        
        
       /* $q=new \yii\db\Query();
        $q->select(['a.numero','a.codcen','a.descripcion','b.despro'])
                ->from('{{%bigitems_docbotellas}} as a' )
                -> innerJoin(\common\models\masters\Clipro::tableName().' as b',
                        'a.codpro='.'b.codpro'
                        );
        echo $q->createCommand()->getRawSql();die();*/
        
        //var_dump($model->getGeneralFormat('hh::ii::ss', 'time', true));die();
       //var_dump(DateTime::createFromFormat($model->getGeneralFormat('dd.mm.yyyy hh::ii::ss', 'datetime', true), '09.07.2015 23:45:01'));die();
       //DateTime::createFromFormat('j/n/Y H:i:s', '09.07.2015 23:45:01')
       /* $model->fectran='23:45:01';
        echo $model->fectran."<br>";
        echo $model->openBorder('fectran',true);die();*/

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }else{
           // print_r($model->getErrors());die();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Docbotellas model.
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
     * Finds the Docbotellas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Docbotellas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Docbotellas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('bigitems.errors', 'The requested page does not exist.'));
    }
    
    
    /*
     * Esta funcion rellena los registoes hijos 
     * con el id recien grabado del padre
     * @valorId: Id integer
     * @items: Array de modelos hijos
     */
    private function linkeaCampos($valorId,$items){
        for($i = 0; $i < count($items); $i++) {
                                $items[$i]->doc_id=$valorId;
           }
       return $items;
        
    }
}
