<?php

namespace frontend\modules\report\models;
use common\models\masters\Centros;
use common\models\masters\Documentos;
use frontend\modules\report\behaviors\FileBehavior;
use Yii;
use common\helpers\h;

class Reporte extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public $imagen;
    public $hardFields=['codocu','modelo'];
    //public $type='pdf';
    public static function tableName()
    {
        return '{{%reportes}}';
    }

    public function behaviors()
{
	return [
		
		'fileBehavior' => [
			'class' => FileBehavior::className()
		],
               
		
	];
}
    
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           [['role'], 'safe'],
            [['xgeneral', 'ygeneral', 'xlogo', 'ylogo', 'x_grilla', 'y_grilla', 'registrosporpagina', 'xresumen', 'yresumen'], 'integer'],
            [['codocu','role', 'codcen', 'modelo', 'nombrereporte', 'campofiltro', 'tamanopapel'], 'required'],
            [['detalle'], 'string'],
            [['codocu'], 'string', 'max' => 3],
            [['registrosporpagina'], 'integer', 'min' => 1],
            [['codcen'], 'string', 'max' => 5],
            [['modelo', 'nombrereporte'], 'string', 'max' => 60],
            [['campofiltro'], 'string', 'max' => 40],
            [['tamanopapel'], 'string', 'max' => 20],
            [['tienepie', 'tienelogo', 'comercial', 'tienecabecera'], 'string', 'max' => 1],
            [['codcen'], 'exist', 'skipOnError' => true, 'targetClass' => Centros::className(), 'targetAttribute' => ['codcen' => 'codcen']],
            [['codocu'], 'exist', 'skipOnError' => true, 'targetClass' => Documentos::className(), 'targetAttribute' => ['codocu' => 'codocu']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'xgeneral' => Yii::t('base.names', 'Xgeneral'),
            'ygeneral' => Yii::t('base.names', 'Ygeneral'),
            'xlogo' => Yii::t('base.names', 'Xlogo'),
            'ylogo' => Yii::t('base.names', 'Ylogo'),
            'codocu' => Yii::t('base.names', 'Codocu'),
            'codcen' => Yii::t('base.names', 'Codcen'),
            'modelo' => Yii::t('base.names', 'Modelo'),
            'nombrereporte' => Yii::t('base.names', 'Nombrereporte'),
            'detalle' => Yii::t('base.names', 'Detalle'),
            'campofiltro' => Yii::t('base.names', 'Campofiltro'),
            'tamanopapel' => Yii::t('base.names', 'Tamanopapel'),
            'x_grilla' => Yii::t('base.names', 'X Grilla'),
            'y_grilla' => Yii::t('base.names', 'Y Grilla'),
            'registrosporpagina' => Yii::t('base.names', 'Registrosporpagina'),
            'tienepie' => Yii::t('base.names', 'Tienepie'),
            'tienelogo' => Yii::t('base.names', 'Tienelogo'),
            'xresumen' => Yii::t('base.names', 'Xresumen'),
            'yresumen' => Yii::t('base.names', 'Yresumen'),
            'comercial' => Yii::t('base.names', 'Comercial'),
            'tienecabecera' => Yii::t('base.names', 'Tienecabecera'),
        ];
    }

    
    public function init(){
        parent::init();
        //if(empty($this->registrosporpagina))
           // throw new \yii\base\Exception(Yii::t('report.messages', 'The module \'registrosporpagina\'  property is empty'));
    }
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportedetalle()
    {
        return $this->hasMany(Reportedetalle::className(), ['hidreporte' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentro()
    {
        return $this->hasOne(Centros::className(), ['codcen' => 'codcen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumento()
    {
        return $this->hasOne(Documentos::className(), ['codocu' => 'codocu']);
    }

    /**
     * {@inheritdoc}
     * @return ReporteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReporteQuery(get_called_class());
    }
    
    /*
     * Cheka si ya tine un registr hijo copn nombe decampo nameField
     */
    public function existsChildField($nameField){
        return (count(Reportedetalle::find()->where(
                ['hidreporte'=>$this->id,
                    'nombre_campo'=>$nameField]
                                    )->asArray()->all())>0)?true:false; 
        
    }
    
    
    /*
     * Hace l acbecera del reporte*
     */
    public function putCabecera($id,$idfiltro){        
        /* $hijos= registros que deen pintarse en la cabcera del reporte   */
             $hijosCabecera=$this->getReportedetalle()->where(['and', "esdetalle='0'", ['or', "visiblelabel='1'", "visiblecampo='1'"]])->all();
		//var_dump($hijosCabecera);die();
             $HTML_cabecera="";
               //var_dump($hijosCabecera);die();
     foreach( $hijosCabecera as $record) {
          // var_dump($this->modelToRepor($idfiltro));die();
		 $HTML_cabecera.=$record->putStyleField($record->nombre_campo,$this->modelToRepor($idfiltro)->{$record->nombre_campo}); 
               }
           unset($modeloToReport);unset($hijosCabecera);unset($clase);
         return $HTML_cabecera;
      }
         
   
      /*
     * Hace cabeera del pdf siempre que sea pdf *
     */
    public function putHeaderReport($id,$idfiltro){
       return  "Date : ".date('Y-m-d H:i:s');
        
      }
      
    
    public function modelToRepor($id){
      $clase=trim($this->modelo);        
        return $clase::find()->where(['id'=>$id])->one();  
    }
    /*
     * Devuel una ruta competa para
     * grabar un archivo en disco 
     */
    public function pathToStoreFile(){
       return  $this->dirFile().DIRECTORY_SEPARATOR.$this->nameReportFile();
    }
    /*
     * Genera nombre de archivo para el reporte
     */
    private function nameReportFile(){
        $name= str_replace(' ','_',$this->nombrereporte).'_'.
                $this->id.'_'.h::userId().'_'.uniqid().'.'.$this->type;
    }
    
    public function sendReportFromMail($fromuser=true){
        h::mailer()->compose()
    ->setFrom('from@domain.com')
    ->setTo('to@domain.com')
    ->setSubject('Asunto del mensaje')
    ->setTextBody('Contenido en texto plano')
    ->setHtmlBody('<b>Contenido HTML</b>')
    ->send();
    }
    
  /*
   * Funcion que renderiza el detalle del reporte 
   * Coouna tabla , desde un grid
   */
    public function makeColumns(){
        $hijosDetalle=$this->
                getReportedetalle()->
                where(['and', "esdetalle='1'", "visiblecampo='1'"])->
                orderBy('orden')->all();
        //echo count( $hijosDetalle);die();
        $columns=[];
        foreach($hijosDetalle as $fila){
             $columns[]=[
                'attribute'=>$fila->nombre_campo,
                'label'=>$fila->aliascampo,
               'format'=>'raw',
                'options'=>['width'=>
              $this->sizePercentCampo($fila->nombre_campo).'%'],
            ];
          
          
        }
        return $columns;
        
    }
    
    
    private function lenghtTotalCampos(){
        return $this->getReportedetalle()->
                where(['and', "esdetalle='1'", "visiblecampo='1'"])->
                sum('longitudcampo');
    }
    
    private function sizePercentCampo($nameField){
       $total= $this->lenghtTotalCampos();
       $ancho=$this->childByNameField($nameField)->longitudcampo;
       return round(100*$ancho/$total);
       
    }
    
    private function childByNameField($nameField){
       return $this->getReportedetalle()->where(['and', "esdetalle='1'", "visiblecampo='1'"])
             ->andWhere(['nombre_campo'=>$nameField])->one();
    }
    
    public function numeroregistros($idfiltro){
        $model= $this->modelo;
        return $model::find()->where([$this->campofiltro => $idfiltro])->count();
    }
    
    public function numeroPaginas($idfiltro){
        try{
            $paginas= ceil($this->numeroregistros($idfiltro)/($this->registrosporpagina+0));
        } catch (Exception $ex) {
            throw new \yii\base\Exception(Yii::t('report.messages', 'The  \'registrosporpagina\'  property is empty'));
  
        }
        return $paginas;
    }
    
    
    public function dataProvider($idfiltro){
       $model= $this->modelo;
       //var_dump($this->campofiltro,$idfiltro);die();
        $query = $model::find()->where([$this->campofiltro => $idfiltro]);
                $provider = new \yii\data\ActiveDataProvider([
                        'query' => $query,
                            'pagination' => [
                                        'pageSize' => $this->registrosporpagina,
                                            ],
                               /* 'sort' => [
                                        'defaultOrder' => [
                                            
                                                            ]
                                            ],*/
                                                ]);
                return $provider;
                  }
     public function beforeSave($insert) {
       
        if($insert){
            $this->type='pdf';
            //$this->prefijo=$this->codfac;
           //$this->resolveCodocu();
           // $this->numero=$this->correlativo('numero');
        }
        
        return parent::beforeSave($insert);
       
    }
}
