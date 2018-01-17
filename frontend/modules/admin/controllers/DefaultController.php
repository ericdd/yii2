<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\modules\admin\models\Buser;

//  访问模块admin的控制器 http://localhost:94/index.php/admin/default/find

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
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

    public function actionSql4()
    {

        $ret = Buser::find()->where(["id" => 3])->asArray()->one();   // 根据条件以数组形式返回一条数据；
        $ret2 = Buser::findOne(4);

        printr($ret);
        printr($ret2);

        return $this->renderPartial('//debug');    // 相当与@app/views/debug
    }

}
