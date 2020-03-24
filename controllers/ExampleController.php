<?php


namespace app\controllers;


use yii\web\Controller;

class ExampleController extends Controller
{
    public function actionIndex() {
        $message = "index action of the ExampleController";
        return $this->render("example",[
            'message' => $message
        ]);
    }

    public function actionHelloWorld() {
        return "Hello world!";
    }
}