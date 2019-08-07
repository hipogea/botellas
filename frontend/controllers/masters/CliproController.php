<?php

namespace frontend\controllers\masters;

use Yii;
use frontend\controllers\base\baseController;
use common\models\masters\Clipro;
use common\models\masters\Direcciones;
use common\models\masters\DireccionesSearch;
use common\models\masters\ContactosSearch;
use common\models\masters\MaestrocliproSearch;
use common\models\masters\ObjetosCliente;
use common\models\masters\ObjetosClienteQuery;
use common\models\masters\ObjetosClienteSearch;
use common\models\masters\CliproSearch;
use common\models\masters\Contactos;
use common\helpers\h;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use yii\web\view;

/**
 * CliproController implements the CRUD actions for Clipro model.
 */
class CliproController extends baseController {
    /* const EDIT_HAS_EDITABLE='hasEditable';
      const EDIT_ARBITRARY='XXY4';
      const EDIT_EDITABLE_KEY='editableKey';
      const EDIT_EDITABLE_INDEX='editableIndex';
      const EDIT_EDITABLE_ATTRIBUTE='editableAttribute';
     */

    public $nameSpaces = ['common\models\masters'];

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
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
     * Lists all Clipro models.
     * @return mixed
     */
    public function actionIndex() {
        
     
        
        
        
       /*$fecha= \Carbon\Carbon::createFromFormat('d.m.Y', '22.08.2019', null);
       var_dump($fecha); die();*/
             
      // $this->layout="install";
        
/* echo h::db()->getSchema()->
                getTableSchema('{{%maestrocompo}}')->
                columns['codart']->size; die();

*/

        $searchModel = new CliproSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Clipro model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Clipro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        /*
         * comantando el procedimieto para agrgar padre hijo en claiente
         * por medio de cajas de texto 
         */
        /* $model = new Clipro();
          $modelDetails = [];

          $formDetails = Yii::$app->request->post('Direcciones', []);
          foreach ($formDetails as $i => $formDetail) {
          $modelDetail = new Direcciones(['scenario' => Direcciones::SCENARIO_BATCH_UPDATE]);
          $modelDetail->setAttributes($formDetail);
          $modelDetails[] = $modelDetail;
          }

          //handling if the addRow button has been pressed
          if (Yii::$app->request->post('addRow') == 'true') {
          $model->load(Yii::$app->request->post());
          $modelDetails[] = new Direcciones(['scenario' => Direcciones::SCENARIO_BATCH_UPDATE]);
          return $this->render('create', [
          'model' => $model,
          'modelDetails' => $modelDetails
          ]);
          }

          if ($model->load(Yii::$app->request->post())) {
          if (Model::validateMultiple($modelDetails) && $model->validate()) {
          $model->save();
          foreach($modelDetails as $modelDetail) {
          $modelDetail->codpro = $model->codpro;
          $modelDetail->save();
          }
          return $this->redirect(['view', 'codpro' => $model->codpro]);
          }
          }

          return $this->render('create', [
          'model' => $model,
          'modelDetails' => $modelDetails
          ]);

         */

















        $model = new Clipro();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->codpro]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Clipro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {

        ///echo  h::convert('28/04/2014');die();
        /* if (!(h::request()->post('hasEditable','x5')==='x5')) {
          $este='\common\models\masters\\'.$this->findKeyArrayInPost();
          $model=$este::findOne( h::request()->post('editableKey'));
          // use Yii's response format to encode output as JSON
          \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
          $model->{h::request()->post('editableAttribute')}=h::request()->post($this->findKeyArrayInPost())[h::request()->post('editableIndex')][h::request()->post('editableAttribute')];
          if ($model->load($_POST)) {
          if ($model->save()) {
          return  \yii\helpers\Json::encode(['output'=>'OK', 'message'=>'SE EDITO SIN PROBLEMAS']);
          }
          else {
          RETURN  ['output'=>'Error', 'message'=>$model->getFirstError()];
          }}else {
          return ['output'=>'', 'message'=>''];
          }
          }
         */
        if ($this->is_editable())
            return $this->editField();

        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->codpro]);
        }
        $searchModel = new DireccionesSearch();
        $dpDirecciones = $searchModel->searchByCodpro($model->codpro);
        $searchModel = new ContactosSearch();
        $dpContactos = $searchModel->searchByCodpro($model->codpro);
        $searchModel = new MaestrocliproSearch();
        $dpMaestroclipro = $searchModel->searchByCodpro($model->codpro);
        
        
        $searchModel = new ObjetosClienteSearch();
        $dpObjetosCliente = $searchModel->searchByCodpro($model->codpro);
        
        
        return $this->render('update', [
                    'model' => $model,
                    'dpDirecciones' => $dpDirecciones,
                    'dpContactos' => $dpContactos,
                    'dpMaestroclipro' => $dpMaestroclipro,
                    'dpObjetosCliente' =>$dpObjetosCliente  
        ]);
    }

    /**
     * Deletes an existing Clipro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCreatecontact($id) {

        //$vendorsForCombo=ArrayHelper::map(Clipro::find()->all(),'codpro','despro');
        $this->layout = "install";
        $modelclipro = $this->findModel($id);
        $model = new Contactos();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //echo \yii\helpers\Html::script("$('#createCompany').modal('hide'); window.parent.$.pjax({container: '#grilla-contactos'})");
            $this->closeModal('buscarvalor', 'grilla-contactos');
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('/masters/contactos/create', [
                        'model' => $model,
                        'id' => $id,
                            //'vendorsForCombo'=>  $vendorsForCombo,
                            //'aditionalParams'=>$aditionalParams
            ]);
        } else {
            $vendorsForCombo = h::getCboClipros();
            return $this->render('/masters/contactos/create', [
                        'model' => $model,
                        'vendorsForCombo' => $vendorsForCombo,
            ]);
        }

        /* $type = $request['type'];
          $category_selector = false;
          if (request()->has('category_selector')) {
          $category_selector = request()->get('category_selector');
          }
          $rand = rand(); */



        /* $modelclipro=$this->findModel($id);
          $model = new Contactos();
          $html = $this->render('modal_contactos',
          ['model'=>$model,
          'aleatorio'=>rand(),
          'titulo'=>'hola amigos']);
          return json_encode([
          'success' => true,
          'error' => false,
          'message' => 'null',
          'html' => $html,
          ]);
          }
         */
    }

    public function actionCreateaddresses($id) {

        //$vendorsForCombo=ArrayHelper::map(Clipro::find()->all(),'codpro','despro');
        $this->layout = "install";
        $modelclipro = $this->findModel($id);
        $model = new Direcciones();
        $model->codpro=$modelclipro->codpro;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //echo \yii\helpers\Html::script("$('#createCompany').modal('hide'); window.parent.$.pjax({container: '#grilla-contactos'})");
            $this->closeModal('buscarvalor', 'grilla-direcciones');
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('/masters/direcciones/create', [
                        'model' => $model,
                        'id' => $id,
                            //'vendorsForCombo'=>  $vendorsForCombo,
                            //'aditionalParams'=>$aditionalParams
            ]);
        } else {
            $vendorsForCombo = h::getCboClipros();
            return $this->render('/masters/direcciones/create', [
                        'model' => $model,
                        //'vendorsForCombo' => $vendorsForCombo,
            ]);
        }

        /* $type = $request['type'];
          $category_selector = false;
          if (request()->has('category_selector')) {
          $category_selector = request()->get('category_selector');
          }
          $rand = rand(); */



        /* $modelclipro=$this->findModel($id);
          $model = new Contactos();
          $html = $this->render('modal_contactos',
          ['model'=>$model,
          'aleatorio'=>rand(),
          'titulo'=>'hola amigos']);
          return json_encode([
          'success' => true,
          'error' => false,
          'message' => 'null',
          'html' => $html,
          ]);
          }
         */
    }
    
    /**
     * Finds the Clipro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Clipro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Clipro::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionCreatex() {
        $model = new Company();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                if (Yii::$app->request->isAjax) {
                    // JSON response is expected in case of successful save
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ['success' => true];
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    private static function xfindKeyArrayInPost() {
        $arr = h::request()->post();
        $valor = null;
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                $valor = $key;
                break;
            }
        }
        return $valor;
    }

    public function xeditField() {
        /* if (!(h::request()->post('hasEditable','x5')==='x5')) {
          $este='\common\models\masters\\'.$this->findKeyArrayInPost();
          $model=$este::findOne( h::request()->post('editableKey'));
          // use Yii's response format to encode output as JSON
          \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
          $model->{h::request()->post('editableAttribute')}=h::request()->post($this->findKeyArrayInPost())[h::request()->post('editableIndex')][h::request()->post('editableAttribute')];
          if ($model->load($_POST)) {
          if ($model->save()) {
          return  \yii\helpers\Json::encode(['output'=>'OK', 'message'=>'SE EDITO SIN PROBLEMAS']);
          }
          else {
          RETURN  ['output'=>'Error', 'message'=>$model->getFirstError()];
          }}else {
          return ['output'=>'', 'message'=>''];
          }
          }
         */

        $este = '\common\models\masters\\' . $this->findKeyArrayInPost();
        $model = $este::findOne(h::request()->post(static::EDIT_EDITABLE_KEY));
        // use Yii's response format to encode output as JSON
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model->{h::request()->post(static::EDIT_EDITABLE_ATTRIBUTE)} = h::request()->
                        post($this->findKeyArrayInPost())[h::request()->
                        post(static::EDIT_EDITABLE_INDEX)][h::request()->post(static::EDIT_EDITABLE_ATTRIBUTE)];

        if ($model->load($_POST)) {
            if ($model->save()) {
                return \yii\helpers\Json::encode(['output' => 'OK', 'message' => 'SE EDITO SIN PROBLEMAS']);
            } else {
                RETURN ['output' => 'Error', 'message' => $model->getFirstError()];
            }
        } else {
            return ['output' => '', 'message' => ''];
        }
    }

    /* private function is_editable(){
      return (!(h::request()->post(static::EDIT_HAS_EDITABLE,
      static::EDIT_EDITABLE_ATTRIBUTE)
      ===static::EDIT_EDITABLE_ATTRIBUTE));
      } */

    public function actionSoloprueba() {
        //$this->layout = 'install';

        


        if (!is_null(h::request()->get('final'))) {
            $nombremodal = h::request()->get('nombremodal');
            $nombremodal = 'buscarvalor';
       // echo ('<script src="/yii-application/frontend/web/assets/5702785/jquery.js"></script>');
           // echo (' <script src="/yii-application/frontend/web/assets/c20c51c7/js/bootstrap.js"></script>');
 //echo ('<script src="/yii-application/frontend/web/assets/7336756e/js/bootstrap-dialog.js"></script>');
          echo \yii\helpers\Html::script(" $('#buscarvalor').modal('hide');");
            
        }
        
         if (Yii::$app->request->isPost) {
              echo \yii\helpers\Html::script(" $('#buscarvalor').modal('hide');");
         
         }
        
        if (Yii::$app->request->isAjax) {
            $searchModel = new \common\models\masters\CliproSearch();
            $dataProvider = $searchModel->search(h::request()->queryParams);
            return $this->renderAjax('/finder/index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        }
    }

    
    public function actionSolodialog(){
       // $this->layout='install';
         $searchModel = new \common\models\masters\CliproSearch();
            $dataProvider = $searchModel->search(h::request()->queryParams);
            RETURN $this->renderAjax('/finder/index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
    }
    
    public function actionCreateObject($id){       

        $this->layout = "install";
        $modelclipro = $this->findModel($id);
        $model = new ObjetosCliente;
        //echo $model::className();die();
        //$model->save();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          // echo "salieeo"; die();  
            //$model->$modelclipro->codpro;
            //echo \yii\helpers\Html::script("$('#createCompany').modal('hide'); window.parent.$.pjax({container: '#grilla-contactos'})");
            $this->closeModal('buscarvalor', 'grilla-objetos');
        } elseif (Yii::$app->request->isAjax) {
            
            //var_dump($model->attributes,$model->getErrors());die();
            //print_r(Yii::$app->request->post());die();
            return $this->renderAjax('objetos', [
                        'model' => $model,
                        'model' => $model,
                        'modelclipro' => $modelclipro,
                        //'id' => $id,
                            //'vendorsForCombo'=>  $vendorsForCombo,
                            //'aditionalParams'=>$aditionalParams
            ]);
        } else {
           echo "salio"; die();
            return $this->render('objetos', [
                        'model' => $model,
                        'modelclipro' => $modelclipro,
                        //'vendorsForCombo' => $vendorsForCombo,
            ]);
        }

        
    }
}
