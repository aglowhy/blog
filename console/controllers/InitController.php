<?php

/**
 * Created by PhpStorm.
 * User: 慕虚云
 * Date: 2015/12/20 0020
 * Time: 23:32
 */
namespace console\controllers;
use common\models\User;

class InitController extends \yii\console\Controller
{
    /**
     * Create init user
     */
    public function actionAdmin()
    {
        echo "Create A Admin Account ...\n";
        $username = $this->prompt('User Name:');
        $email = $this->prompt('Email:');
        $password = $this->prompt('Password:');
        $model = new User();
        $model->username = $username;
        $model->email = $email;
        $model->password = $password;
        $model->generateAuthKey();
        if (!$model->save())
        {
            foreach ($model->getErrors() as $error)
            {
                foreach ($error as $e)
                {
                    echo "$e\n";
                }
            }
            return 1;
        }
        return 0;
    }
}