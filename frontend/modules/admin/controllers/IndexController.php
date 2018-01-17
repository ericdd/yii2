<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\modules\admin\models\Buser;

//  访问模块admin的控制器 http://localhost:94/index.php/admin/default/find

/**
 * Default controller for the `admin` module
 */
class IndexController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        echo __FUNCTION__, '<br />';
        echo $this->id, '<br />';
        echo $this->action->id, '<br />';
        return $this->renderPartial('//test');
    }

    // 打印$this, 查看具体信息
    public function actionThis()
    {
        echo $this->module->defaultRoute, '<br />';
        echo $this->module->layout, '<br />';
//        echo $this->module->requestedRoute, '<br />';        //当前浏览器的路由

        printr($this);
        die("");
    }

    //  将参数传递到layouts/main.php中
    public function actionView1()
    {
        $msg = '<h1>将参数传递到layouts中</h1>';
        return $this->render('../view', ['msg' => $msg]);
    }

    public function actionSql4()
    {

        $ret = Buser::find()->where(["id" => 3])->asArray()->one();   // 根据条件以数组形式返回一条数据；
        $ret2 = Buser::findOne(4);

        printr($ret);
        printr($ret2);

        return $this->renderPartial('//debug');    // 相当与@app/views/debug
    }

}
