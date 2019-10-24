<?php
use Mpdf\Mpdf;
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
            $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
            $fontDirs = $defaultConfig['fontDir'];
            $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
            $fontData = $defaultFontConfig['fontdata'];

//$mpdf = new \common\components\MyMpdf([/*
$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs,[
       Yii::getAlias('@fonts')
    ]),
    'fontdata' => $fontData + [
        'cour' => [
            'R' => 'cour.ttf',
            'I' => 'CourierITALIC.ttf',
        ]
    ],
    //'default_font' => 'cour'
]);

//print_r($mpdf->fontdata);die();
          
          //$mpdf=new \Mpdf\Mpdf();
          //echo get_class($mpdf);die();
          /* $pdf->methods=[ 
           'SetHeader'=>[($model->tienecabecera)?$header:''], 
            'SetFooter'=>[($model->tienepie)?'{PAGENO}':''],
        ];*/
           $mpdf->simpleTables = true;
                 $mpdf->packTableData = true;
           
          $paginas=count($contenido);
          //echo $contenido[0];die();
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
  
  public function actionTestPdf(){
      $mpdf=new \Mpdf\Mpdf();
      $page='
<div style="position:absolute;
     width:280px;height:80px;
     padding:0px; top:9px;
     left:9px; border-style:solid; border-width:1px; border-color:#e1e1e1 ">
</div>

<div style="position:absolute; padding:1px;border-style:none; 
     top:10px; left:10px; ">
    				<div style="float:left">
	<img src="/frontend/web/attachments/file/download?id=142" width="100" height="70" alt="">				</div>

</div>
<div style="position:absolute;  padding:0px; float:left; left:110px; top:20px;">

							<span style="font-family:courier; font-size:10px !important;">
								NEOTEGNIA CONSULTORES SAC							</span>
	<div  >
							<span style="font-family:courier; font-size:7px !important;">
															</span>
	</div>
	<div>
							<span style="font-family:courier; font-size:7px !important;">
								Rucsoc : 20600279832							</span>
	</div>
	<div >
							<span style="font-family:courier; font-size:7px !important;">
								Telefonos : 							</span>
	</div>
	<div >
							<span style="font-family:courier; font-size:7px !important;">
								Mail : jramirez@neotegnia.com    							</span>
	</div>
</div>



<div style=" position:absolute;  left:284px;  top:92px;  font-size:8;  font-family:arial;  color:#000; ">Numero</div><div style=" position:absolute;  left:334px;  top:92px;  font-size:12;  font-family:arial;  font-weight:bold;  color:#f00; ">14500001</div>     <html lang="es">
    
   




<div style=" position:absolute;  left:284px;  top:92px;  font-size:8;  font-family:arial;  color:#000; ">Numero</div><div style=" position:absolute;  left:334px;  top:92px;  font-size:12;  font-family:arial;  font-weight:bold;  color:#f00; ">14500001</div><div style="position:absolute; width:80%; left:20px; top:400px">
  <div id="detallerepoGrid" class="grid-view"><div class="summary">Mostrando <b>1-1</b> de <b>1</b> elemento.</div>
<table class="table table-striped table-bordered"><thead>
<tr><th><a href="/frontend/web/report/make/creareporte?id=1&amp;idfiltro=14&amp;sort=id" data-sort="id">ID</a></th><th><a href="/frontend/web/report/make/creareporte?id=1&amp;idfiltro=14&amp;sort=codfac" data-sort="codfac">Facultad</a></th><th><a href="/frontend/web/report/make/creareporte?id=1&amp;idfiltro=14&amp;sort=fecha" data-sort="fecha">Fecha</a></th><th><a href="/frontend/web/report/make/creareporte?id=1&amp;idfiltro=14&amp;sort=fechacorte" data-sort="fechacorte">F Corte</a></th><th><a href="/frontend/web/report/make/creareporte?id=1&amp;idfiltro=14&amp;sort=version" data-sort="version">Version</a></th><th><a href="/frontend/web/report/make/creareporte?id=1&amp;idfiltro=14&amp;sort=codperiodo" data-sort="codperiodo">Periodo</a></th><th><a href="/frontend/web/report/make/creareporte?id=1&amp;idfiltro=14&amp;sort=comentario" data-sort="comentario">Comentario</a></th><th><a href="/frontend/web/report/make/creareporte?id=1&amp;idfiltro=14&amp;sort=descripcion" data-sort="descripcion">Descripcion</a></th><th><a href="/frontend/web/report/make/creareporte?id=1&amp;idfiltro=14&amp;sort=detalles" data-sort="detalles">Detalles</a></th><th><a href="/frontend/web/report/make/creareporte?id=1&amp;idfiltro=14&amp;sort=tienecabecera" data-sort="tienecabecera">File carga con cabecera</a></th><th><a href="/frontend/web/report/make/creareporte?id=1&amp;idfiltro=14&amp;sort=modelo" data-sort="modelo">Tabla</a></th><th><a href="/frontend/web/report/make/creareporte?id=1&amp;idfiltro=14&amp;sort=escenario" data-sort="escenario">Acción</a></th><th><a href="/frontend/web/report/make/creareporte?id=1&amp;idfiltro=14&amp;sort=numero" data-sort="numero">Numero</a></th><th><a href="/frontend/web/report/make/creareporte?id=1&amp;idfiltro=14&amp;sort=codocu" data-sort="codocu">Codocu</a></th></tr>
</thead>
<tbody>
<tr data-key="14"><td>14</td><td><span class="not-set">(no definido)</span></td><td>17/10/2019</td><td>09/10/2019</td><td>1</td><td>2004II</td><td><span class="not-set">(no definido)</span></td><td>ENTREGA DE ORCE ALUM,NOS </td><td></td><td>1</td><td>\frontend\modules\sta\models\Alumnos</td><td>import_medio</td><td>14500001</td><td>145</td></tr>
</tbody></table>
</div>

</div>



            
  
    <script src="/frontend/web/assets/194207b6/yii.js"></script>
<script src="/frontend/web/assets/194207b6/yii.gridView.js"></script>
<script>jQuery(function ($) {
jQuery("#detallerepoGrid").yiiGridView({"filterUrl":"\/frontend\/web\/report\/make\/creareporte?id=1\u0026idfiltro=14","filterSelector":"#detallerepoGrid-filters input, #detallerepoGrid-filters select","filterOnFocusOut":true});
});</script>    </body>
    </html>
    

       
       
       
       
       
       <div class="pagebreak"> </div>';
      $html='<div style=" position:absolute;  left:400px;  top:52px;  font-size:8;  font-family:verdana;  color:#000; ">Numero</div><div style=" position:absolute;  left:334px;  top:52px;  font-size:12;  font-family:verdana;  font-weight:bold;  color:#f00; ">14500001</div> ';
  $mpdf->WriteHTML($page);
    return $mpdf->Output();   
  }      
        
        
}
