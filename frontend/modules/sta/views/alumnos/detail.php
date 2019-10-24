<?php
use yii\widgets\DetailView;
echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'profile_id',
            'codcar',
            'ap',
            'am',
            'nombres',
            'fecna',
            'codalu',
            'dni',
            'domicilio',
            'codist',
            'codprov',
            'codep',
            'sexo',
        ],
    ]); ?>


