<?php

namespace frontend\modules\import\models;

use Yii;

/**
 * This is the model class for table "{{%import_cargamasiva}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $insercion
 * @property string $escenario
 * @property string $lastimport
 * @property string $descripcion
 * @property string $format
 * @property string $modelo
 *
 * @property ImportCargamasivadet[] $importCargamasivadets
 */
class ImportCargamasiva extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%import_cargamasiva}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'insercion', 'escenario', 'descripcion', 'format', 'modelo'], 'required'],
            [['user_id'], 'integer'],
            [['insercion'], 'string', 'max' => 1],
            [['escenario', 'descripcion'], 'string', 'max' => 40],
            [['lastimport'], 'string', 'max' => 18],
            [['format'], 'string', 'max' => 3],
            [['modelo'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('import.labels', 'ID'),
            'user_id' => Yii::t('import.labels', 'User ID'),
            'insercion' => Yii::t('import.labels', 'Insercion'),
            'escenario' => Yii::t('import.labels', 'Escenario'),
            'lastimport' => Yii::t('import.labels', 'Lastimport'),
            'descripcion' => Yii::t('import.labels', 'Descripcion'),
            'format' => Yii::t('import.labels', 'Format'),
            'modelo' => Yii::t('import.labels', 'Modelo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImportCargamasivadets()
    {
        return $this->hasMany(ImportCargamasivadet::className(), ['cargamasiva_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ImportCargamasivaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImportCargamasivaQuery(get_called_class());
    }
}
