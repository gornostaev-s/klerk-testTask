<?php
namespace app\resources;

use app\models\User;

class UserResource extends User
{
    public function fields()
    {
        return [
            'id',
            'name',
            'surname',
            'patronymic',
            'phones',
            'updated_by'
        ];
    }
}