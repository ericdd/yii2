<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "buser".
 *
 * @property int $id
 * @property string $name
 * @property string $pwd
 * @property int $type
 * @property string $email
 * @property string $phone
 * @property int $date
 * @property string $last_login_ip
 */
class Buser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'buser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'pwd', 'type', 'email', 'phone', 'date', 'last_login_ip'], 'required'],
            [['type', 'date'], 'integer'],
            [['name'], 'string', 'max' => 60],
            [['pwd'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 35],
            [['phone'], 'string', 'max' => 11],
            [['last_login_ip'], 'string', 'max' => 15],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'pwd' => 'Pwd',
            'type' => 'Type',
            'email' => 'Email',
            'phone' => 'Phone',
            'date' => 'Date',
            'last_login_ip' => 'Last Login Ip',
        ];
    }
}
