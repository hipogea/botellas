<?php
use yii\widgets\DetailView;
echo DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'codalu',
           // 'id',
           // 'profile_id',
           // 'codcar',
           // 'ap',
           // 'am',
           // 'nombres',
           // 'fecna',
            
            'dni',
            'domicilio',
            'celulares',
            'correo',
            
        ],
    ]); ?>


