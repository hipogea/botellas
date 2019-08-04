<?php

namespace frontend\modules\report\controllers;
use common\models\masters\Sociedades;
use Yii;
use frontend\modules\report\Module as ModuleReporte;
use frontend\modules\report\models\Reporte;
use frontend\modules\report\models\Reportedetalle;
use frontend\modules\report\models\ReportedetalleSearch;
use frontend\modules\report\models\ReporteSearch;
use common\controllers\base\baseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MakeController implements the CRUD actions for Reporte model.
 */
class MakeController extends baseController
{
   public $nameSpaces = ['frontend\modules\report\models'];
    
    
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
     * Lists all Reporte models.
     * @return mixed
     */
    public function actionIndex()
    {
         /*yii::$app->session->setFlash('success',yii::t('report.messages','Se agregaron registros hijos '));
	
        $this->redirect(\yii\helpers\Url::toRoute('/masters/clipro/index'));*/
       // $model=$this->findModel(3);
        //$clase=trim($model->modelo);
       // $dataProvider=$model->dataProvider(13);
        
        //var_dump($dataProvider);DIE();
        // $dataProvider->pagination->page = 2; //Set page 1
         // $dataProvider->refresh(); //Refresh models
         // var_dump($dataProvider->models);die();
        
       	
       /* \common\helpers\h::mailer()->
                compose()->setFrom('hipogea@hotmail.com')
    ->setTo('hipogea@hotmail.com')
    ->setSubject('Asunto del mensaje')
    ->setTextBody('Contenido en texto plano')
    ->setHtmlBody('<b>Contenido HTML</b>')
    ->send();die();*/
       /*$model=$this->findModel(3);
        $clase=trim($model->modelo);
        $modelToReport= $clase::find()->where(['id'=>10])->one();
       var_dump( $modelToReport->despro);die();*/
       // echo \common\helpers\FileHelper::getShortName("//hipogeA.xls");die();
        
        $searchModel = new ReporteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reporte model.
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
     * Creates a new Reporte model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reporte();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Reporte model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
       
        
//var_dump($model->existsChildField('deslarga'));die();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
      
        /*Para el edit en caliente */
        if ($this->is_editable())
            return $this->editField();
        
        /*Para crear el detalle */
        if(!$model->hasChilds()){
            $this->CreaDetalle($id);
        }else{
            $this->CreaDetalle($id,true);
        }
          
      
        /*Para renderizar el grilla*/
          $searchModel = new ReportedetalleSearch();
       $dataProvider = $searchModel->searchByReporte(
               Yii::$app->request->queryParams,
               $model->id
               
               );

        
        
        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->codocu]);
        }*/

        return $this->render('update', [
            'model' => $model,
            'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
        
       
    }

    /**
     * Deletes an existing Reporte model.
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
     * Finds the Reporte model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reporte the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reporte::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('report.messages', 'The requested page does not exist.'));
    }
    
    
    public function CreaDetalle($id,$refresh=false){
		$modeloreporte=$this->findModel($id);
		$nombremodelo=$modeloreporte->modelo;
		$modeloareportar=new $nombremodelo;
                $columnas=$modeloareportar->getTableSchema()->columns;
		$contador=0; 
                
              foreach($columnas as $nameField=>$oBCol){ 
                 // echo "verificando sai existe ;".$nameField."<br>";
			if(!$modeloreporte->existsChildField($nameField) ){ //SI NO ESTA , ENTONCES INSERTARLO
				 //echo "no existe insertarlo  ".$nameField."<br>";
                             Reportedetalle::firstOrCreateStatic(Reportedetalle::prepareValues($id,
                                    $modeloreporte->codocu, 
                                    $nameField,
                                    $modeloareportar->getAttributeLabel($nameField), 
                                    $oBCol->size, 
                                    $oBCol->dbType));
                                 $contador+=1;
			}else{
                          // echo "ya  existe np pasa nad  ".$nameField."<br>"; 
                        }
		}
                //print_r(array_keys($columnas));die();
        /* foreach( array_diff(
               array_keys(get_object_vars ($modeloareportar)),
               array_keys($modeloareportar->attributes)
                            ) as $campoadicional){        
           if(!$modeloreporte->existsChildField($campoadicional) ) { //SI NO ESTA , ENTONCES INSERTARLO
                           Reportedetalle::firstOrCreateStatic(Reportedetalle::prepareValues($id,
                                    $modeloreporte->codocu, 
                                    $campoadicional,
                                    $campoadicional, 
                                    40, 
                                    'varchar(40)'));
               $contador+=1;
           }
       }*/
        if($contador > 0 ){
                yii::$app->session->setFlash('success',yii::t('report.messages','Se agregaron '.$contador.' registros hijos '));
		}else {
			yii::$app->session->setFlash('information',yii::t('report.messages', 'No se agregaron registros hijos ya existen todos'));
		}
                if(!$refresh)
		return $this->redirect(array('update','id'=>$modeloreporte->id));
	}

  public function actionUpdatedetallerepo($id){
         $this->layout = "install";
        //$modelReporte = $this->findModel($id);
        $model = Reportedetalle::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //var_dump(Yii::$app->request->post());die();
            //echo \yii\helpers\Html::script("$('#createCompany').modal('hide'); window.parent.$.pjax({container: '#grilla-contactos'})");
            $this->closeModal('buscarvalor','detallerepoGrid');
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_detalle', [
                        'model' => $model,
                        'id' => $id,
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
  
  public function actionCreareporte($id, $idfiltro){
     // echo $this->putLogo($id, $idfiltro);die();
       $model=$this->findModel($id); 
       $this->layout='blank';
      // return $this->render('reporte_1');
      
      $model=$this->findModel($id);      
      $logo=($model->tienelogo)?$this->putLogo($id, $idfiltro):'';      
         $header=$model->putHeaderReport($id, $idfiltro); 
         
          $cabecera=$model->putCabecera($id,$idfiltro);
         
      /*$pdf->methods=[ 
           'SetHeader'=>[($model->tienecabecera)?$header:''], 
            'SetFooter'=>[($model->tienepie)?'{PAGENO}':''],
        ];*/
    
       $contenidoSinGrilla=$logo.$cabecera; 
       //var_dump($model->numeroPaginas($idfiltro));die();
      $npaginas=$model->numeroPaginas($idfiltro);
       
      $contenido="";
      $dataProvider=$model->dataProvider($idfiltro);
    
     // var_dump($dataProvider);die();
      $pageContents=[]; //aray con las paginas cotneido un elemento potr pagina
      for($i = 1; $i <= $npaginas; $i++){
          $dataProvider->pagination->page = $i-1; //Set page 1
          $dataProvider->refresh(); //Refresh models
          
         $pageContents[]=$contenidoSinGrilla.$this->render('reporte',[
             'modelo'=>$model,
             
             'dataProvider'=>$dataProvider,
             'contenidoSinGrilla'=>$contenidoSinGrilla,
             'columnas'=>$model->makeColumns(),             
                 ]).$this->pageBreak();
         
         
              }
      return $this->prepareFormat($pageContents, $model);
     
     }
     //die();
      //$contenido=$this->render('reporte',['modelo'=>$model,'cabecera'=>$cabecera]);
     
     //return  $this->prepareFormat($contenido, $model);
     // return $this->render('reporte',['modelo'=>$model,'cabecera'=>$cabecera]);
  
  
  private function pageBreak(){
      return "<div class=\"pagebreak\"> </div>";
  }
      
  
     /*
       * Hace el logo del Reporte
       */
    private function putLogo($id, $idfiltro){
        $model=$this->findModel($id);        
        return $this->renderpartial('logo',
				array(
			'modelosociedad' =>Sociedades::find()->one(),
                         'model'=>$model/*->modelToRepor($idfiltro)*/,
			'idreporte'=>$id,
					//'xlogo'=>$xlogo,
					//'ylogo'=>$ylogo,
					//'rutalogo'=>$rutalogo,
				),TRUE,	true);
        
    }
  
 /*Prepar el foramto de salida 
  * delñ reporte 
  */
  private function prepareFormat($contenido,$model){
      if($model->type=='pdf'){
          $mpdf=new \Mpdf\mPDF();
          //echo get_class($mpdf);die();
          /* $pdf->methods=[ 
           'SetHeader'=>[($model->tienecabecera)?$header:''], 
            'SetFooter'=>[($model->tienepie)?'{PAGENO}':''],
        ];*/
           $mpdf->simpleTables = true;
                 $mpdf->packTableData = true;
          $paginas=count($contenido);
         foreach($contenido as $index=>$pagina){
            $mpdf->WriteHTML($pagina);
            if($index < $paginas-1)
             $mpdf->AddPage();
         }
              
         
        
         return $mpdf->Output(); 
      }elseif($model->type=='html'){
          return $contenido[0];
      }elseif($model->type=='file'){
          $pdf=ModuleReporte::getPdf();
           $pdf->methods=[ 
           'SetHeader'=>[($model->tienecabecera)?$header:''], 
            'SetFooter'=>[($model->tienepie)?'{PAGENO}':''],
        ];
        $pdf->content=$contenido;
        $pdf->output($contenido, $model->pathToStoreFile());
        return true;
      }
      
      
      
        }  
    
}
