<?php

namespace frontend\controllers;

use Yii;
use app\models\Blog;
use app\models\Buser;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

//use  yii\web\Session;

class TestController extends Controller
{

    public $layout = '';

    // public $defaultAction = 'admin';        //设置admin是默认的方法名

    public function actions()
    {
        //	echo rand();
    }

    // 别名以 @ 开头 很多地方可以直接使用别名，而不用调用 Yii::getAlias() 转换成真实的路径或URL。
    // common\config\bootstrap.php设置
    public function actionAlias()
    {
        echo Yii::$app->basePath,'<br />';
        echo \Yii::$app->request->BaseUrl,'+++<br />';
        echo Yii::getAlias("@yii"),'<br />';
        echo Yii::getAlias("@webroot"),'<br />';
        echo Yii::getAlias("@app"),'<br />';
        echo Yii::getAlias("@frontend"),'<br />';
        echo Yii::getAlias("@backend"),'<br />';
        echo Yii::getAlias("@common"),'<br />';


        return $this->renderPartial('//debug'); //使用双斜线“//”，程序就会从视图文件夹开始搜索
    }

    public function actionIndex()
    {
        echo __FUNCTION__, '<br />';
        echo $this->id, '<br />';
        echo $this->action->id, '<br />';
        return $this->renderPartial('//test', ['name' => 'name', 'msg' => 'message']);

    }

    public function actionSelf()
    {
        echo __FUNCTION__, '<br />';

    }

    public function actionView()
    {

        $msg = '<h1>aaaaa</h1>';
        return $this->renderPartial('//test', ['name' => 'name', 'msg' => $msg]);
    }

    // 打印common/config和frontend/config中params.php和params-local.php的配置
    public function actionConf()
    {
        printr(\Yii::$app->params);
    }


    public function actionModel($id = 1)
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

    // 执行原生 SQL 查询  queryXyz() 方法都处理的是从数据库返回数据的查询语句
    public function actionSql()
    {
        $ret = Yii::$app->db->createCommand('SELECT * FROM admin WHERE admin_id = 1')->queryOne();
        $ret2 = Yii::$app->db->createCommand('SELECT admin_name FROM admin WHERE admin_id < 4')->queryColumn();
        $ret3 = Yii::$app->db->createCommand('SELECT * FROM admin WHERE admin_id < 4')->queryAll();
        printr($ret);
        printr($ret2);
        printr($ret3);
    }

//      绑定参数
    public function actionSql2()
    {
        $params = [':id' => 2, ':status' => 3];

        $ret = Yii::$app->db->createCommand('SELECT * FROM admin WHERE admin_id=:id AND admin_type=:status')->bindValues($params)->queryOne();
        $ret2 = Yii::$app->db->createCommand('SELECT * FROM admin WHERE admin_id=:id AND admin_type=:status', $params)->queryOne();
        $ret3 = Yii::$app->db->createCommand('SELECT * FROM admin WHERE admin_id=:id AND admin_type=:status')->bindValue(':id', 3)->bindValue(':status', 9)->queryOne();

        printr($ret);
        printr($ret2);
        printr($ret3);
    }

//      执行非查询语句
    public function actionSql3()
    {

        $mt = mt_rand(20, 100);

        $ret = Yii::$app->db->createCommand('UPDATE buser SET type=1 WHERE id=11')->execute();
        $ret2 = Yii::$app->db->createCommand()->update('buser', ['type' => rand(1, 100)], 'id > 30')->execute();
        $ret3 = Yii::$app->db->createCommand()->delete('buser', "id = $mt")->execute();

        printr($ret);
        printr($ret2);
        printr($ret3);


        $ret4 = Yii::$app->db->createCommand()->insert('buser', [
            'name' => 'Sam' . rand(),
            'type' => 3,
        ])->execute();

        printr($ret4);
    }

//      orm
    public function actionSql4()
    {

        $condition = ["id" => 1];
        $ret = Buser::find()->where($condition)->asArray()->one();   // 根据条件以数组形式返回一条数据；
        $ret2 = Buser::find()->where($condition)->asArray()->all();

        printr($ret);
        printr($ret2);

        $ret = Buser::find()->one();    //此方法返回一条数据；   Buser::find()->all();    //此方法返回所有数据；
        $ret2 = Buser::find()->count();   // 此方法返回记录的数量；
        $ret3 = Buser::findOne(2);

        printr($ret);
        printr($ret2);
        printr($ret3);

        return $this->renderPartial('//debug');

    }

    public function actionFind()
    {
        $ret = Buser::find()->asArray()->one();          //   执行的是SELECT * FROM `buser`
        $ret2 = Buser::findOne(2);                        // SELECT * FROM `buser` WHERE `id`=10

        printr($ret);
        printr($ret2);

        return $this->renderPartial('//debug');        // 调用debug条，方便查看sql执行情况和session
    }

    // 显示debug条
    public function actionBug()
    {
        return $this->renderPartial('//debug');
    }


}

?>