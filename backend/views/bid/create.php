<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\Bid */

$this->title = 'Create Bid';
$this->params['breadcrumbs'][] = ['label' => 'Bids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bid-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'company_list' => $company_list,
        'tender_list' => $tender_list,
    ]) ?>

</div>
