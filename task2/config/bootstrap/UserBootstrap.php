<?php

namespace app\config\bootstrap;

use \Yii;
use \yii\base\BootstrapInterface;
use \app\storages\UserStorage;
use \app\services\UserService;

/**
 * UserBootstrap
 */
class UserBootstrap implements BootstrapInterface {

    public function bootstrap($app){


        $container = \Yii::$container;

        $container->set('\app\storages\StorageInterface', function() {
            return new UserStorage(Yii::$app->db);
        });

        $container->setSingleton(UserService::class);

//        echo  '<pre>'; var_dump($container->get('\app\services\UserService')); die;

        //или так
        //Выбираем один вариант регистрации хранилища, а другой комментим
//        $container->set('app\storages\StorageInterface',[
//            'class' => 'UserStorage',
//            'connection' => Yii::$app->db,
//        ]);
    }

}