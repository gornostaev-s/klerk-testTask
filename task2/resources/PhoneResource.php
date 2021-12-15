<?php
namespace app\resources;

use app\models\Phone;

class PhoneResource extends Phone
{
    public function fields()
    {
        return [
            'id',
            'phone'
        ];
    }
}