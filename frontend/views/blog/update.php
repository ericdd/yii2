<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Blog */

$this->title = 'Update Blog: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="blog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="form-group field-blog-create_time">
        <label class="control-label" for="blog-aaa">测试字段</label>
        <input type="text" id="blog-aaa" class="form-control" name="Blog[aaa]" value="">

        <div class="help-block"></div>
    </div>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
