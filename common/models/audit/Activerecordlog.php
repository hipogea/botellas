<?php

namespace common\models\audit;

use Yii;

/**
 * This is the model class for table "{{%activerecordlog}}".
 *
 * @property string $id
 * @property string $model
 * @property string $field
 * @property string $ip
 * @property string $creationdate
 * @property string $controlador
 * @property string $description
 * @property string $nombrecampo
 * @property string $oldvalue
 * @property string $newvalue
 * @property string $username
 * @property string $metodo
 * @property string $action
 * @property string $clave
 */
class Activerecordlog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%activerecordlog}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave'], 'string'],
            [['model', 'field', 'nombrecampo'], 'string', 'max' => 45],
            [['ip', 'creationdate'], 'string', 'max' => 20],
            [['controlador'], 'string', 'max' => 60],
            [['description'], 'string', 'max' => 105],
            [['oldvalue', 'newvalue'], 'string', 'max' => 80],
            [['username'], 'string', 'max' => 30],
            [['metodo'], 'string', 'max' => 7],
            [['action'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models.labels', 'ID'),
            'model' => Yii::t('models.labels', 'Model'),
            'field' => Yii::t('models.labels', 'Field'),
            'ip' => Yii::t('models.labels', 'Ip'),
            'creationdate' => Yii::t('models.labels', 'Creationdate'),
            'controlador' => Yii::t('models.labels', 'Controlador'),
            'description' => Yii::t('models.labels', 'Description'),
            'nombrecampo' => Yii::t('models.labels', 'Nombrecampo'),
            'oldvalue' => Yii::t('models.labels', 'Oldvalue'),
            'newvalue' => Yii::t('models.labels', 'Newvalue'),
            'username' => Yii::t('models.labels', 'Username'),
            'metodo' => Yii::t('models.labels', 'Metodo'),
            'action' => Yii::t('models.labels', 'Action'),
            'clave' => Yii::t('models.labels', 'Clave'),
        ];
    }
}
