<?php

namespace app\controllers;

use app\components\Taxi;
use app\models\RegistrationForm;
use app\models\UploadImageForm;
use Yii;
use yii\base\DynamicModel;
use yii\bootstrap\ActiveForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSay($message = 'Hello')
    {
        return $this->render('say', ['message' => $message]);
    }

    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->get()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $model]);
        }
    }

    public function actionTestGet() {
        var_dump(Yii::$app->request->userHost);
        var_dump(Yii::$app->request->userIP);
    }

    public function actionTestResponse() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->redirect('http://www.tutorialspoint.com/');
    }

    public function actionMaintenance() {
        echo "<h1>Maintenance</h1>";
    }

    public function actionRoutes() {
        return $this->render('routes');
    }

    public function actionRegistration() {
        $model = new RegistrationForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request>post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        return $this->render('registration', ['model' => $model]);
    }

    public function actionAdHocValidation() {
        $model = DynamicModel::validateData([
            'username' => 'John',
            'email' => 'john@gmail.com'
        ], [
            [['username', 'email'], 'string', 'max' => 12],
            ['email', 'email'],
        ]);

        if ($model->hasErrors()) {
            var_dump($model->errors);
        } else {
            echo "success";
        }
    }

    public function actionAccessSession() {

        $session = Yii::$app->session;

        // set a session variable
        $session->set('language', 'ru-RU');

        // get a session variable
        $language = $session->get('language');
        var_dump($language);

        // remove a session variable
        $session->remove('language');

        // check if a session variable exists
        if (!$session->has('language')) echo "language is not set";

        $session['captcha'] = [
            'value' => 'aSBS23',
            'lifetime' => 7200,
        ];
        var_dump($session['captcha']);
    }

    public function actionShowFlash() {
        $session = Yii::$app->session;
        // set a flash message named as "greeting"
        $session->setFlash('greeting', 'Hello user!');
        return $this->render('showflash');
    }

    public function actionReadCookies() {
        // get cookies from the "request" component
        $cookies = Yii::$app->request->cookies;
        // get the "language" cookie value
        // if the cookie does not exist, return "ru" as the default value
        $language = $cookies->getValue('language', 'ru');
        // an alternative way of getting the "language" cookie value
        if (($cookie = $cookies->get('language')) !== null) {
            $language = $cookie->value;
        }
        // you may also use $cookies like an array
        if (isset($cookies['language'])) {
            $language = $cookies['language']->value;
        }
        // check if there is a "language" cookie
        if ($cookies->has('language')) echo "Current language: $language";
    }

    public function actionSendCookies() {
        // get cookies from the "response" component
        $cookies = Yii::$app->response->cookies;
        // add a new cookie to the response to be sent
        $cookies->add(new Cookie([
            'name' => 'language',
            'value' => 'ru-RU',
        ]));
        $cookies->add(new Cookie([
            'name' => 'username',
            'value' => 'John',
        ]));
        $cookies->add(new Cookie([
            'name' => 'country',
            'value' => 'USA',
        ]));
    }

    public function actionUploadImage() {
        $model = new UploadImageForm();
        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->upload()) {
                // file is uploaded successfully
                echo "File successfully uploaded";
                return;
            }
        }
        return $this->render('upload', ['model' => $model]);
    }

    public function actionFormatter(){
        return $this->render('formatter');
    }

    public function actionProperties() {
        echo "222222222";
        $obj = new Taxi();
//        // equivalent to $phone = $object->getPhone();
        $phone = $obj->phone;
//        var_dump($phone);
//        // equivalent to $object->setLabel('abc');
//        $obj->phone = '79005448877';
//        var_dump($obj);
    }
}