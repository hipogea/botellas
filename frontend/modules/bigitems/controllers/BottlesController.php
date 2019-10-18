<?php

namespace frontend\modules\bigitems\controllers;

use Yii;use DateTime;
use frontend\modules\bigitems\models\Docbotellas;
use frontend\modules\bigitems\models\Activos;
use common\helpers\h;
use frontend\modules\bigitems\models\viewsmodels\VwDocbotellasSearch;
use frontend\modules\bigitems\models\Detdocbotellas;
use common\controllers\base\baseController;
use common\models\base\modelBase;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;
use yii\base\Model;
use yii\web\Response;
use yii\filters\VerbFilter;

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
    
       //var_dump( h::settings()->get('general','esnumerico')); die();
        
        $searchModel = new VwDocbotellasSearch();
       //var_dump($searchModel->getShortNameClass()); die();
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
        //$model->valuesDefault();

       //var_dump($model->attributes);die();
        
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
        
       /* VAR_DUMP(Yii::$app->request->post('Detdocbotellas'));
        echo "<br>";
        */
        
        
          //$items=[new Detdocbotellas()];
          //$request = Yii::$app->getRequest();
         if(Yii::$app->request->isPost){
             $arraydetalle=Yii::$app->request->post('Detdocbotellas');
             $arraycabecera=Yii::$app->request->post('Docbotellas');
             
             /*Nos aseguramos que los indices se reseteen con array_values
              * ya que cada vez que borramos con ajax en el form quedan 
              * vacancias en los indices y al momento de hacer el loadMultiple
              * no coinciden los indices; algunos modelos no cargan los atributos
              * y arroja false 
              */
             
             //Pero primero guardamos los indices del form antes de resetearlo
             //para despues restablecerlos; esto para enviar los mensajes de error
             // con la accion Form::ValidateMultiple()
             $OldIndices=array_keys($arraydetalle);
             //Ahora si reseteamos los indices para hacerl el loadMultiple
             $arraydetalle=array_values($arraydetalle);
             
             
             
             /*Generamos los items necesarios*/           
              $items = $this->generateItems(Detdocbotellas::className(),
                      count($arraydetalle),
                      Detdocbotellas::SCENARIO_CREACION_TABULAR
                      );
              
              
                           
         if ( h::request()->isAjax &&
                  $model->load($arraycabecera,'')&& 
                 Model::loadMultiple($items, $arraydetalle,'')
                  ) {
                // var_dump( $model->load($arraycabecera,''));
               // VAR_DUMP($model->attributes);DIE();
              //VAR_DUMP($arraycabecera);DIE();
             
             
             /*Antes de hacer Form::ValidateMultiple() , reestablecemos los 
              * indices originales, de esta manera nos aseguramos que los
              * mensajes de error salgan cada cual en su sitio
              */
             $items=array_combine($OldIndices,$items);
                h::response()->format = Response::FORMAT_JSON;
                 return array_merge(ActiveForm::validate($model),
                 ActiveForm::validateMultiple($items));
                
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
        //var_dump($items);
       /* $arreglo=Yii::$app->request->post('Detdocbotellas');
        $arreglo=array_values($arreglo);
        var_dump($arreglo);
        echo "<br>";
        echo "<br>";
        echo "<br><br>";
        echo " load mulpitple :";
        var_dump(Model::loadMultiple($items, $arreglo,''));
        echo "<br><br>";
       
             
       ECHO "SIN LA LINKEADA <BR>";
         foreach($items as $item){
            print_r($item->attributes);
                        if($item->validate(null)){
                           echo $item->codigo."->".$item->getFirstError()."<br>";
                        }else{
                          echo \yii\helpers\Json::encode($item->getErrors())."->fallo <br><br><br>";
                        }
                           }
        
        ECHO "<br>AHORA CON LA LINKEADA<BR><BR>";
        
         $items=$this->linkeaCampos(18, $items);
        foreach($items as $item){
            echo "El form  ".$item->formName()."<br>";
            print_r($item->attributes);
                        if($item->validate(null)){
                           echo $item->codigo."->".$item->getFirstError()."<br>";
                        }else{
                          echo \yii\helpers\Json::encode($item->getErrors())."->fallo <br><br><br>";
                        }
                           }
        var_dump(Model::validateMultiple($items));DIE();
        
        */
        
        if ($model->load($arraycabecera,'') &&       
        Model::loadMultiple($items, $arraydetalle,'')&&
         $model->validate()   ){
            VAR_DUMP($model->attributes);
            print_r($model->getSafeFields());
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
         $items=$this->generateItems(Detdocbotellas::className(),
         Docbotellas::gsettingConfig('nitemsdefault', 7), //cantidad de items por defeto al crear
                 Detdocbotellas::SCENARIO_CREACION_TABULAR);
         foreach($items as $index=> $item){           
             $valor=100+$index;
             $item->coditem= $valor.'';
         }
         /*Aqui colocamos los valores por default*/
         
         $model->valuesDefault();
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
       
          $items=$model->detdocbotellas;
         $contador=count($items);
         $indexOrigin=array_keys($items);
         if(h::request()->isPost){
             $arraydetalle=h::request()->post('Detdocbotellas');
             $arraycabecera=h::request()->post('Docbotellas');             
             //print_r($arraydetalle);die();
             $indexNew=array_keys($arraydetalle);
             $borrados=array_diff($indexOrigin,$indexNew);
             $agregados=array_diff($indexNew,$indexOrigin);
             //$actualizados= array_intersect($indexNew, $indexOrigin);
             
             /*
              * PARA LOS BORRADOS*/
               foreach($borrados as $key){
                   $items[$key]->delete();
                   unset($items[$key]);
               }
               
            /*PARA LOS AGREGADOS*/
               foreach($agregados as $key){
                   $items[$key]=new Detdocbotellas;
               }
           
                           
         if ( h::request()->isAjax &&
                  $model->load($arraycabecera,'')&& 
                 Model::loadMultiple($items, $arraydetalle,'')
                  ) {
               //echo count($items);die();
               h::response()->format = Response::FORMAT_JSON;
                 return array_merge(ActiveForm::validate($model),
                 ActiveForm::validateMultiple($items));
                
        }
            
        
        if ($model->load($arraycabecera,'') &&       
        Model::loadMultiple($items, $arraydetalle,'')&&
         $model->validate()   ){
              $model->save();$model->refresh();
               $items=array_values($items);//resetear
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
         
         foreach($items as $index=> $item){
             $item->setScenario($item::SCENARIO_UPDATE_TABULAR);            
         }
         
        return $this->render('update', [
            'model' => $model,'items'=>$items
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
    private function linkeaCampos($valorId,&$items){
        for($i = 0; $i < count($items); $i++) {
                                $items[$i]->doc_id=$valorId;
           }
       return $items;
        
    }
    

    public function actionAjaxBorrarBotella(){
        $this->deleteModel($id, $modelClass);
    }
    
}
