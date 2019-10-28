<?php

namespace frontend\modules\sta\models;

use Yii;

/**
 * This is the model class for table "{{%sta_cursos}}".
 *
 * @property string $codcur
 * @property string $nomcur
 */
class Cursos extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_cursos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codcur','nomcur'], 'required'],
            [['codcur'], 'string', 'max' => 10],
            [['nomcur'], 'string', 'max' => 70],
            [['codcur'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codcur' => Yii::t('sta.labels', 'Código'),
            'nomcur' => Yii::t('sta.labels', 'Nombre'),
        ];
    }
    
     public function scenarios()
    {
        $scenarios = parent::scenarios(); 
        $scenarios['import'] = ['codcur','nomcur'];
       /* $scenarios[self::SCENARIO_STATUS] = ['activo'];
        $scenarios[self::SCENARIO_RUNNING] = ['activo','current_linea','total_linea','fechacarga'];
 $scenarios['fechita'] = ['fechacarga'];*/
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     * @return CursosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CursosQuery(get_called_class());
    }
}
