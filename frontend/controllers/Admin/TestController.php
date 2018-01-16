<?php

namespace frontend\controllers\Admin;

use Yii;
use app\models\Blog;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

//use  yii\web\Session;

class TestController extends Controller
{

    public function actionIndex()
    {
        echo __FUNCTION__, '<br />';
        echo $this->id, '<br />';
        echo $this->action->id, '<br />';
        return $this->renderPartial('../index', ['name' => 'name', 'msg' => 'message']);

    }

    public function actionSelf()
    {
        echo __FUNCTION__, '<br />';

    }

    public function actionView()
    {

        return $this->renderPartial('../index', ['name' => 'name', 'msg' => 'message']);

    }

    public function actionFind($id = 1)
    {
        $model = Blog::findOne($id);
        printr($model);

    }

    public function actionSess($id = 1)
    {
        echo $_SESSION['__id'], '<br />';        // yii2的登录会产生这个session id
        if (!$_SESSION['_aa']) {
            $_SESSION['_aa'] = mt_rand();
        }
        printr($_SESSION);

        $sess = \Yii::$app->session;
        $sess->set('name_string', '小明abc');
        $sess->set('name_array', [1, 2, 3]);

        echo $sess->get('name_string'), '<br />';
        printr($sess->get('name_array'));
    }
}

?>