<?php
namespace backend\components;

use Yii;

class MyBehavior extends \yii\base\ActionFilter
{
    public function beforeAction ($action)
    {
        var_dump("ddd@@@@@##@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@1@@@1111111111111111111@@@@@\n");
        return true;
    }

    public function isGuest ()
    {
        return Yii::$app->user->isGuest;
    }

}