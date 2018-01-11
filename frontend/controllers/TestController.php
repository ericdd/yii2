<?php

namespace frontend\controllers;

use Yii;
use app\models\Blog;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class TestController extends Controller {

	public $layout = '';

	public function actions() {
	//	echo rand();
	}

	public function actionIndex() {
		echo __FUNCTION__ ,'<br />';
		echo $this->id, '<br />';
		echo $this->action->id,'<br />';
		return $this->renderPartial('../index', ['name'=>'name','msg'=>'message']);

	}

	public function actionSelf() {
		echo __FUNCTION__,'<br />';

	}

	public function actionView() {

		return $this->renderPartial('../index', ['name'=>'name','msg'=>'message']);

	}

    public function actionFind($id = 1)
    {
        $model = Blog::findOne($id);

//        if ($model === null) {
//            throw new NotFoundHttpException;
//        }

		printr($model);

    }
}

?>