<?php

namespace frontend\controllers;

use Yii;
use app\models\Blog;
use app\models\Buser;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class TestController extends Controller
{

    public $layout = '';

    public function actions()
    {
        //	echo rand();
    }

    public function actionIndex()
    {
        echo __FUNCTION__, '<br />';
        echo $this->id, '<br />';
        echo $this->action->id, '<br />';
        return $this->renderPartial('../test', ['name' => 'name', 'msg' => 'message']);

    }

    public function actionSelf()
    {
        echo __FUNCTION__, '<br />';

    }

    public function actionView()
    {

        $msg = '<h1>aaaaa</h1>';

        return $this->renderPartial('../test', ['name' => 'name', 'msg' => $msg]);

    }

    public function actionModel($id = 1)
    {
        $model = Blog::findOne($id);
        printr($model);

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

        $condition = ["id"=>1];
        $ret = Buser::find()->where($condition)->asArray()->one();   // 根据条件以数组形式返回一条数据；
        $ret2 = Buser::find()->where($condition)->asArray()->all();   // 根据条件以数组形式返回所有数据；

        printr($ret);
        printr($ret2);

        $ret = Buser::find()->one();    //此方法返回一条数据；   Buser::find()->all();    //此方法返回所有数据；
        $ret2 = Buser::find()->count();   // 此方法返回记录的数量；
        $ret3 = Buser::findOne(10);

        printr($ret);
        printr($ret2);
        printr($ret3);
    }

}

?>