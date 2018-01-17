<?php

namespace frontend\controllers\api;

use Yii;
use app\models\Buser;

class PostsController extends \yii\web\Controller
{

//   访问二级目录下的控制器 http://localhost:94/index.php/api/posts/find
    public function actionIndex2()
    {
        return $this->render('//index');
    }

    public function actionIndex()
    {
        echo __FUNCTION__, '<br />';
        echo $this->id, '<br />';
        echo $this->action->id, '<br />';
        return $this->render('//test', ['name' => '小米', 'msg' => '<h2>给控制器分类可以使用模块modules，也可以使用二级目录</h2>']);

    }

    public function actionFind()
{
    $ret = Buser::find()->asArray()->one();
    $ret2 = Buser::findOne(2);

    printr($ret);
    printr($ret2);

    return $this->renderPartial('//debug');
}

}
