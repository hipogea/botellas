<?php

namespace frontend\controllers\masters;

use Yii;
use common\models\masters\Valoresdefault;
use common\models\masters\ValoresdefaultSearch;
use common\controllers\base\baseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\masters\Documentos;
use common\helpers\ComboHelper;
use common\helpers\h;

use yii\helpers\Html;


/**
 * ValoresdefaultController implements the CRUD actions for Valoresdefault model.
 */
class ValoresdefaultController extends baseController
{
   const ESCENARIO_CREACION='creacion';
    
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
     * Lists all Valoresdefault models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ValoresdefaultSearch();
       // var_dump(Yii::$app->request->queryParams);die();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Valoresdefault model.
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
     * Creates a new Valoresdefault model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       //var_dump(h::request()->post());die();
        $model = new Valoresdefault();
        $model->activo=true;
      if(h::request()->isPost){
          
          
          $arreglo=h::request()->post();
          $nombrecampo=$arreglo['Valoresdefault']['nombrecampo'];
         // VAR_DUMP($nombrecampo);die();
          $avalues=array_values($arreglo);
          if(isset($arreglo['Valoresdefault']['valor'])){
              $valor=$arreglo['Valoresdefault']['valor'];
          }else{
            foreach($avalues as $arraypequenis){
              if(isset($arraypequenis[$nombrecampo])){
                  $valor=$arraypequenis[$nombrecampo];break; 
              }
            }  
          }
          
          //print_r($avalues);
          
          $model->setScenario(SELF::ESCENARIO_CREACION);
          $model->attributes=$arreglo['Valoresdefault'];
         
          $model->user_id=h::userId();
          $model->valor=$valor;
           if(h::request()->isAjax){
              h::response()->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($model);
          }//VAR_DUMP($model->attributes);die();
           if ( $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
            }else{
           //var_dump($model->attributes,$model->getErrors());die();
         }
      }
       

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Valoresdefault model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
       // var_dump($model->attributes,$model->getAttributes());die();
       // var_dump(h::request()->post());die();
        if(h::request()->isPost){
            
         if(h::request()->isAjax){
              h::response()->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($model);
          }
          $arreglo=h::request()->post();
          $nombrecampo=$arreglo['Valoresdefault']['nombrecampo'];
         // VAR_DUMP($nombrecampo);die();
          $avalues=array_values($arreglo);
          $valor=$arreglo['Valoresdefault']['nombrecampo'];
          if(isset($arreglo['Valoresdefault']['valor'])){
              $valor=$arreglo['Valoresdefault']['valor'];
          }else{
            foreach($avalues as $arraypequenis){
              if(isset($arraypequenis[$nombrecampo])){
                  $valor=$arraypequenis[$nombrecampo];break; 
              }
            }  
          }
          $model->setScenario(SELF::ESCENARIO_CREACION);
          $model->attributes=$arreglo['Valoresdefault'];
         
          $model->user_id=h::userId();
          $model->valor=$valor;
        if ($model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        }
        
        /*Sis e trata de un campo link*/
        if($model->isFieldLinkForTable()){
            $data=[];
           $table=new $model->documento->tabla;
           $table->{$model->nombrecampo}=$model->valor;
            $claseforanea=$table->obtenerForeignClass($model->nombrecampo);
            $campoforaneo=$table->obtenerForeignField($model->nombrecampo);
            $registro=$claseforanea::find()->where([$campoforaneo=>$model->valor])->one();
           //var_dump($registro->possibleSearchables());die();
            $camposbuscables=array_keys($registro->possibleSearchables());
            $j=0;
            foreach($registro->attributes as $nombretemp=>$valortemp){
                if($camposbuscables[0]==$nombretemp){
                    break;
                }
                $j++;
            }
            //VAR_DUMP($camposbuscables,$j);DIE();
            $ordenCampo=$j;
            
            $data[$model->valor]=$registro->{$camposbuscables[0]};
            //var_dump($data);die();
            //$campos=[];
           return $this->render('update_con_widget', ['modeltabla'=>$table,
            'model' => $model,/*'data'=>$data,*/'ordenCampo'=>$ordenCampo,'campos'=>$table->attributeLabels()
                        ]); 
            
        }else{
            // var_dump($model->documentos->tabla);die();
        $table=new $model->documento->tabla;
       // $claseforanea=$table->obtenerForeignClass($model->nombrecampo);        
        $campos=$table->attributeLabels();
       
        return $this->render('update', [
            'model' => $model,'campos'=>$campos
        ]); 
        }
        
      
    
}
    /**
     * Deletes an existing Valoresdefault model.
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
     * Finds the Valoresdefault model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Valoresdefault the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Valoresdefault::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('base.names', 'The requested page does not exist.'));
    }
    
public function actionAjaxFillFields(){
    if(h::request()->isAjax && h::request()->post('filtro')!==null){
        $docu=Documentos::find()->where([
            'codocu'=>h::request()->post('filtro')
                ])->one();
        if(!is_null($docu)){
            if(empty($docu->tabla))
               throw new \yii\base\Exception(Yii::t('base.errors','The attribute "tabla" from {Documento} is empty',['{Documento}'=>$docu->desdocu]));
            $table=new $docu->tabla;            
            return Html::renderSelectOptions('', array_merge( [''=>'--'.yii::t('base.verbs','Choose a Value').'--'],  $table->attributeLabels()) );
                }
        
    }
}
    
public function actionAjaxProposalValues(){
    if(h::request()->isAjax &&
       h::request()->post('filtro')!==null &&
       h::request()->post('campo')!==null ){ 
        $datos=[];
         h::response()->format = \yii\web\Response::FORMAT_JSON;
        $docu=Documentos::find()->where([
            'codocu'=>h::request()->post('filtro')
                ])->one();
        $campo=h::request()->post('campo');
        if(!is_null($docu)){
            if(empty($docu->tabla)){
              $datos['error']=yii::t('base.errors','The attribute "tabla" from {Documento} is empty',['{Documento}'=>$docu->desdocu]);
              
            }else{
                $table=new $docu->tabla; 
                 $mod=new Valoresdefault();
                if($table instanceof \common\models\base\modelBase ){
                     if(in_array($campo,array_keys($table->fieldsLink(false)))){
                        $modeloforeaneo=$table->obtenerForeignClass($campo);
                        $campoforaneo=$table->obtenerForeignField($campo); 
                    $datos['html']= $this->renderAjax('_campo_value',
                            [
                        'table'=>$table,
                         'campo'=>$campo
                    ]).Html::activeHiddenInput($mod, 'aliascampo',['value'=>$mod->getAttributeLabel($campo)]);
                        
                    }else{
                      
                       $datos['html']="<div class='form-group field-valoresdefault-valor'> ".
                               Html::label(yii::t('base.names','value'),'valoresdefault-valor')
                               .Html::activeTextarea($mod, 'valor',['class'=>'form-control'])."</div>"
                               .Html::activeHiddenInput($mod, 'aliascampo',['value'=>$mod->getAttributeLabel($campo)]);
                 }
                   
                }else{
                   $datos['error']=yii::t('base.errors','Table associated to this document is not subclass from "baseModel" ');
             
                }
            }
               //throw new \yii\base\Exception(Yii::t('base.errors','The attribute "tabla" from {Documento} is empty',['{Documento}'=>$docu->desdocu]));
                      
            
                }else{
                    $datos['error']=yii::t('base.errors','Document with {code} not found',['code'=>h::request()->post('filtro')]);
           
              
                }
                return $datos;
        
    }
}


}
