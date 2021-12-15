<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\resources\UserResource;

class Phone extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%phones}}';
    }

    public function rules(){
        return [
            ['phone', 'match', 'pattern' => '/[0-9]{11}$/', 'message' => 'Неверный формат номера телефона' ],
            [['user_id'], 'integer'],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(UseResource::class, ['user_id' => 'id']);
    }
}