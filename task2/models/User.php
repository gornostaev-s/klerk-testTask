<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;
use app\resources\PhoneResource;

class User extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%users}}';
    }

    public function getPhones()
    {
        return $this->hasMany(PhoneResource::class, ['user_id' => 'id']);
    }

    public function rules()
    {
        return [
            [['name', 'surname','patronymic'], 'required'],
//            [['name', 'surname','patronymic'], 'string'],
        ];
    }
}