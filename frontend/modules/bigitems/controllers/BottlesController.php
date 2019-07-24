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
        
       /* VAR_DUMP(Yii::$app->request->post('Detdocbotellas'));
        echo "<br>";
        */
        
        
          $items=[new Detdocbotellas()];
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
             
             
             
              $count = count($arraydetalle);              
              $items = [new Detdocbotellas()];
              
                        for($i = 1; $i < $count; $i++) {
                                $items[] = new Detdocbotellas();
               
                                }
              foreach($items as$item){
             $item->setScenario($item::SCENARIO_CREACION_TABULAR);
             
                   }  
                           
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
         foreach($items as $index=> $item){
             $item->setScenario($item::SCENARIO_CREACION_TABULAR);
             $valor=100+$index;
             $item->coditem= $valor.'';
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
    private function linkeaCampos($valorId,&$items){
        for($i = 0; $i < count($items); $i++) {
                                $items[$i]->doc_id=$valorId;
           }
       return $items;
        
    }
    
    
     /*
     * Esta funcion rellena un registro hijo 
      * renderizando la vista detalle 
     * 
     */
    public function actionAjaxAddItem(){
       if(h::request()->isAjax){
        $form=/*unserialize(base64_decode(h::request()->post('form')));*/ new \yii\widgets\ActiveForm;
        $clase=str_replace('_','\\',h::request()->post('model'));
        $model= new $clase;
         $orden=h::request()->post('orden');
         $orden=4;
         //$form=h::request()->post('form');
         //var_dump($form);
        /* var_dump(unserialize($form));*/
        //h::response()->format = \yii\web\Response::FORMAT_JSON;
         return $this->renderAjax('item',
                 [
                     'form'=>$form,
                     'item'=>$model,
                     'orden'=>$orden,
                 'auto'=>false,
                 ]);
       }
            
          
        
    }
}
