<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\db\search\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    $form = \yii\widgets\ActiveForm::begin();
    echo $form->field($searchModel, 'search_field', [
        'template' => '<div class="input-group">{input}<span class="input-group-btn">' .
            Html::submitButton('Search', ['class' => 'btn btn-default']) .
            '</span></div>',
    ])->textInput(['placeholder' => 'Search']);
    $form->end();
    ?>

    <p>
        <?= Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'adress',
            'phone',
            'contact_user',
            // 'register_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
