<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kecamatan */

$this->title = 'Create Kecamatan';
$this->params['breadcrumbs'][] = ['label' => 'Kecamatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
<div class="kecamatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
