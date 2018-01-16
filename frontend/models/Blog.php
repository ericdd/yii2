<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $create_time
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['title', 'content'], 'required'],
            [['title'], 'string', 'max' => 100],
            [['content'], 'string', 'min' => 3, 'max' => 100],
            [['create_time'], 'safe'],
			['create_time', 'default', 'value' => date('Y-m-d H:i:s',time())],		// 设置默认值
        ];

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',           //id为数据表中的字段名，ID 为表单显示的描述
            'title' => '标题',
            'content' => '内容',
            'create_time' => '创建时间',
            'aa' => '不存在的字段',
        ];
    }
}
