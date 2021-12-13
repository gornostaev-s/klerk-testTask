<?php

namespace app\controllers;

use yii\rest\ActiveController;

class UserController extends ActiveController
{
    private $service;

//    public function __construct($id, $module, Bo $service, $config = [])
//    {
//        $this->service = $service;
//        parent::__construct($id, $module, $config);
//    }

    public function actionIndex()
    {
        return [];
    }

}