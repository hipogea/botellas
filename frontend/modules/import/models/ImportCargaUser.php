<?php

namespace frontend\modules\import\models;

use Yii;

/**
 * This is the model class for table "{{%import_carga_user}}".
 *
 * @property int $id
 * @property int $cargamasiva_id
 * @property string $fechacarga
 * @property int $user_id
 * @property string $descripcion
 * @property int $current_linea
 * @property int $total_linea
 * @property string $tienecabecera
 * @property string $duracion
 *
 * @property ImportCargamasiva $cargamasiva
 */
class ImportCargaUser extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%import_carga_user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cargamasiva_id', 'user_id', 'descripcion'], 'required'],
            [['cargamasiva_id', 'user_id', 'current_linea', 'total_linea'], 'integer'],
            [['fechacarga'], 'string', 'max' => 18],
            [['descripcion', 'duracion'], 'string', 'max' => 40],
            [['tienecabecera'], 'string', 'max' => 1],
            [['cargamasiva_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImportCargamasiva::className(), 'targetAttribute' => ['cargamasiva_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('import.labels', 'ID'),
            'cargamasiva_id' => Yii::t('import.labels', 'Cargamasiva ID'),
            'fechacarga' => Yii::t('import.labels', 'Fechacarga'),
            'user_id' => Yii::t('import.labels', 'User ID'),
            'descripcion' => Yii::t('import.labels', 'Descripcion'),
            'current_linea' => Yii::t('import.labels', 'Current Linea'),
            'total_linea' => Yii::t('import.labels', 'Total Linea'),
            'tienecabecera' => Yii::t('import.labels', 'Tienecabecera'),
            'duracion' => Yii::t('import.labels', 'Duracion'),
        ];
    }

    
      public function behaviors()
        {
	return [
		
		'fileBehavior' => [
			'class' => FileBehavior::className()
		]
		
	];
            }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargamasiva()
    {
        return $this->hasOne(ImportCargamasiva::className(), ['id' => 'cargamasiva_id']);
    }

    /**
     * {@inheritdoc}
     * @return ImportCargaUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImportCargaUserQuery(get_called_class());
    }
}
