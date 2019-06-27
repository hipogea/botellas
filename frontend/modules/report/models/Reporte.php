<?php

namespace frontend\modules\report\models;
use common\models\masters\Centros;
use common\models\masters\Documentos;
use Yii;

class Reporte extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public $imagen;
    public $hardFields=['codocu','modelo'];
    public static function tableName()
    {
        return '{{%reportes}}';
    }

    public function behaviors()
{
	return [
		
		'fileBehavior' => [
			'class' => \nemmo\attachments\behaviors\FileBehavior::className()
		]
		
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
    public function getCentros()
    {
        return $this->hasOne(Centros::className(), ['codcen' => 'codcen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
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
    
    
}
