<?php

namespace app\models;

use yii\base\Model;

class User extends Model
{
    public static function tableName()
    {
        return '{{%users}}';
    }

    public function rules(){
        return [
            ['phone', 'match', 'pattern' => '\+[0-9] \([0-9]{3}\) [0-9]{3}-[0-9]{2}-[0-9]{2}$', 'message' => 'Неверный формат номера телефона' ],
        ];
    }
}