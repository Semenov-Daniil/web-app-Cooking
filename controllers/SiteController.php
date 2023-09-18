<?php

namespace app\controllers;

use app\models\Composition;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegisterForm;
use yii\data\ArrayDataProvider;

class SiteController extends Controller
{
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
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
        if ((Yii::$app->session)['enter'] == 3) {
            (Yii::$app->session)->destroy();
            return $this->goHome();
        }
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

    public function actionRegister()
    {
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->userRegister()) {
                Yii::$app->user->login($user);
                return $this->goHome();
            }
        }
        return $this->render('register', [
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

    public function actionVegetablesPassirovka()
    {
        $query = Composition::vegetablesPassirovka();
        (Yii::$app->session)['array'] = $query;
        $provider = new ArrayDataProvider([
            'allModels' => $query,
            'pagination' => false,
        ]);
        return $this->render('vegetables-passirovka', [
            'dataProvider' => $provider,
        ]);
    }

    public function actionCalorie()
    {
        $provider = new ArrayDataProvider([
            'allModels' => Composition::calorie(),
            'pagination' => false,
        ]);
        return $this->render('calorie', [
            'dataProvider' => $provider,
        ]);
    }

    public function actionSpices()
    {
        $provider = new ArrayDataProvider([
            'allModels' => Composition::spices(),
            'pagination' => false,
        ]);
        return $this->render('spices', [
            'dataProvider' => $provider,
        ]);
    }

    public function actionListFirstDishes()
    {
        $provider = new ArrayDataProvider([
            'allModels' => Composition::listFirstDishes(),
            'pagination' => false,
        ]);
        return $this->render('list-first-dishes', [
            'dataProvider' => $provider,
        ]);
    }

    public function actionExport()
    {
        $list = (Yii::$app->session)['array'];
        
        $fp = fopen(Yii::getAlias('@app') . '\export_file\file.csv', 'w+');

        foreach ($list as $fields) {
            fputcsv($fp, $fields, ';');
        }

        fclose($fp);

        $filePath = Yii::getAlias('@app') . '\export_file\file.csv';
        $fileName = 'file.csv';

        // Создание экземпляра класса Response
        $response = Yii::$app->response;

        $response->format = Response::FORMAT_RAW;
        $response->headers->add('Content-Type', 'text/csv');
        $response->headers->add('Content-Disposition', "attachment; filename='$fileName'");

        // Установка других параметров, например, кэширование
        $response->sendFile($filePath)->send();
    }
}
