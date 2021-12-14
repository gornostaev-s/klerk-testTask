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
        echo '<pre>';
        var_dump($service); die;
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