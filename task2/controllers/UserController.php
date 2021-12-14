<?php

namespace app\controllers;

use app\models\User;
use yii\rest\Controller;
use yii\validators\Validator;
use \app\services\UserService;
use Yii;

class UserController extends Controller
{
    private $service;

    public function __construct($id, $module, UserService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator'] = [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ]
        ];

        return $behaviors;
    }

    public function actionIndex()
    {
        echo '<pre>';
        var_dump(123, $this->service->getUsers());
        die;
        return [];
    }

    public function actionCreate()
    {
        $user = new User();
        if ($user->load(Yii::$app->request->post()) && $user->validate()) {

            $data = [
                'name' => $user->name,
                'surname' => $user->surname,
                'patronymic' => $user->patronymic,
                'phones' => $user->phones,
            ];

            $this->service->createUser($data);
        }

    }

}