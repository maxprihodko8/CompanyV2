<?php
use kartik\datetime\DateTimePicker;

echo '<label class="control-label">' . $modelName . '</label>';
echo DateTimePicker::widget([
    'model' => $model,
    'attribute' => $modelName,
    'options' => ['placeholder' => 'enter end time'],
    'pluginOptions' => [
        'autoclose' => true
    ]
]);