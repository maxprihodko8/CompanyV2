<?php
use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'description',
        'price',
        'begin_time',
        // 'tender_id',
        'end_time',
        'companyName',
        'tenderName',
        'resultTime',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>