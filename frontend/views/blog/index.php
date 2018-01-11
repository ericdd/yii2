<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blogs';
$this->params['breadcrumbs'][] = $this->title;
?>

<style type="text/css">
.container{width:92%;}
.blog-index{}
table {table-layout: fixed;word-wrap:break-word;}
.grid-view td{white-space:normal;}
</style>
<div class="blog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Blog', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		//'headerOptions' => ['max-width' => '50%'],
		//'tableOptions'=>['style'=>'word-wrap:break-word;word-break:break-all;'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

		//	'contentOptions'=>['style'=>'max-width: 100px;'] ,
            'id',
            'title',
            'content:ntext',
            'create_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>


