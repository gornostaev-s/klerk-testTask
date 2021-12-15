<?php

namespace app\controllers;

use app\models\User;
use app\models\Phone;
use yii\db\Exception;
use yii\rest\Controller;
use app\resources\UserResource;
use Yii;

class UserController extends Controller
{
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
        return UserResource::find()->all();
    }

    public function actionView($id)
    {
        return UserResource::findOne(['id' => $id]);
    }

    public function actionUpdate($id)
    {
        $data = Yii::$app->request->post();
        $phones = !empty($data['phones'])? $data['phones'] : [];
        $user = User::findOne(['id' => $id]);
        $user->load($data,'');
        $userId = $user->id;

        $error = [
            'success' => false,
            'message' => 'Полученные данные некорректны'
        ];

        if($user->load($data,'') && $user->validate()){
            $err = [];
            foreach ($phones as $phone) {
                $phoneInstance = Phone::findOne(['id' => $phone['id'], 'user_id' => $userId]);

                if (empty($phone['phone']) && !empty($phoneInstance)){
                    $phoneInstance->delete();
                    continue;
                }

                if (empty($phoneInstance)){
                    $phoneInstance = new Phone();
                    $phoneInstance->load(['user_id' => $userId, 'phone' => $phone]);
                }

                $phoneInstance->phone = $phone['phone'];

                if ($phoneInstance->validate()){
                    $phoneInstance->save();
                    continue;
                }

                $err[] = "В номере телефона {$phone['phone']} содержится ошибка";
            }

            $user->updated_by = date('Y-m-d H:i:s');

            $user->save();

            return [
                'success' => true,
                'data' => [
                    'id' => $userId
                ],
                'messages' => $err
            ];
        }


        return $error;
    }

    public function actionCreate()
    {
        $data = Yii::$app->request->post();

        $user = new User();
        $phones = !empty($data['phones'])? $data['phones'] : [];
        unset($data['phones']);

        $user->load($data, '');

        $error = [
            'success' => false,
            'message' => 'Полученные данные некорректны'
        ];


        if ($user->validate()){
            $user->save();
            $userId = $user->id;
            $err = [];
            foreach ($phones as $phone) {
                $phoneInstance = new Phone();

                if (empty($userId)){
                    return $error;
                }

                $phoneInstance->load(['phone' => $phone,'user_id' => $userId],'');

                if ($phoneInstance->validate()){
                    $phoneInstance->save();
                    continue;
                }

                $err[] = "В номере телефона $phone содержится ошибка";
            }

            $res = [
                'success' => true,
                'data' => [
                    'id' => $userId
                ],
                'messages' => $err
            ];

            return $res;
        }

        return $error;

    }

    public function actionDelete($id)
    {
        $user = User::findOne(['id' => $id]);
        if (!empty($user)){
            $user->delete();

            return [
                'success' => true,
                'data' => [
                    'id' => $id
                ],
            ];
        }
        return [
            'success' => false,
            'message' => "Пользователь с id: $id не найден"
        ];

    }

}