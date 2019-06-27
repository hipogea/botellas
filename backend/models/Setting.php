<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Setting extends Model
{
    /**
     * @var string application name
     */
    public $formatDB;

    /**
     * @var string admin email
     */
    public $formatUSER;

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['formatDB', 'formatUSER'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'formatDB' => Yii::t('install.procedures', 'Format for store Database'),
            'formatUSER' => Yii::t('install.procedures', 'Format to Show Users'),
        ];
    }
}
