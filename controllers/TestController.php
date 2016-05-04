<?php

namespace app\controllers;

class TestController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        return $this->render('index', ['id' => $id]);
    //    return $this->renderContent("Hello world");
    //    return "Hello!";
    }

}
