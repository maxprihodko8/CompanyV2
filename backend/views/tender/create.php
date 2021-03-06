<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\Tender */

$this->title = 'Create Tender';
$this->params['breadcrumbs'][] = ['label' => 'Tenders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tender-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'bids_list' => $bids_list,
        'company_list' => $company_list,
    ]) ?>

</div>
