<?php

namespace frontend\modules\sta\models;

use Yii;

/**
 * This is the model class for table "{{%sta_materias}}".
 *
 * @property string $codcur
 * @property string $nomcur
 * @property string $activa
 * @property int $creditos
 * @property string $codfac
 * @property string $electivo
 * @property int $ciclo
 *
 * @property StaAluriesgo[] $staAluriesgos
 * @property StaFacultades $codfac0
 */
class Materias extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_materia}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codcur','codcar','ciclo','creditos','electivo'], 'required'],
            [['creditos', 'ciclo'], 'integer'],
            [['codcur'], 'string', 'max' => 10],
            //[['nomcur'], 'string', 'max' =>70],
            [['activa', 'electivo'], 'string', 'max' => 1],
            [['codcar'], 'string', 'max' => 6],
            [['codcur'], 'string', 'max' => 10],
            ['codcur', 'unique', 'targetAttribute' => ['codcur', 'codcar','ciclo']], 
            [['codcur'], 'exist', 'skipOnError' => true,'message'=>yii::t('sta.labels','Este curso {cursito} no existe Verifique',['cursito'=>$this->codcur]), 'targetClass' => Cursos::className(), 'targetAttribute' => ['codcur' => 'codcur']],
            [['codcar'], 'exist', 'skipOnError' => true,'message'=>yii::t('sta.labels','Esta carrera  no existe Verifique'), 'targetClass' => Carreras::className(), 'targetAttribute' => ['codcar' => 'codcar']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codcur' => Yii::t('sta.labels', 'Codcur'),
           // 'nomcur' => Yii::t('sta.labels', 'Nomcur'),
            'activa' => Yii::t('sta.labels', 'Activa'),
            'creditos' => Yii::t('sta.labels', 'Creditos'),
            'codfac' => Yii::t('sta.labels', 'Codfac'),
            'electivo' => Yii::t('sta.labels', 'Electivo'),
            'ciclo' => Yii::t('sta.labels', 'Ciclo'),
        ];
    }

    
      public function scenarios()
    {
        $scenarios = parent::scenarios(); 
        $scenarios['import'] = ['codcur','codcar','ciclo','activa','creditos','electivo'];
       /* $scenarios[self::SCENARIO_STATUS] = ['activo'];
        $scenarios[self::SCENARIO_RUNNING] = ['activo','current_linea','total_linea','fechacarga'];
 $scenarios['fechita'] = ['fechacarga'];*/
        return $scenarios;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaAluriesgos()
    {
        return $this->hasMany(Aluriesgo::className(), ['codcur' => 'codcur']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
    
    
    public function getFacultad()
    {
        return $this->hasOne(Carreras::className(), ['codcar' => 'codcar']);
    }

    /**
     * {@inheritdoc}
     * @return MateriasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MateriasQuery(get_called_class());
    }
}
