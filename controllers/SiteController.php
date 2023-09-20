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
        $query = Composition::calorie();
        (Yii::$app->session)['array'] = $query;
        $provider = new ArrayDataProvider([
            'allModels' => $query,
            'pagination' => false,
        ]);
        return $this->render('calorie', [
            'dataProvider' => $provider,
        ]);
    }

    public function actionSpices()
    {
        $query = Composition::spices();
        (Yii::$app->session)['array'] = $query;
        $provider = new ArrayDataProvider([
            'allModels' => $query,
            'pagination' => false,
        ]);
        return $this->render('spices', [
            'dataProvider' => $provider,
        ]);
    }

    public function actionListFirstDishes()
    {
        $query = Composition::listFirstDishes();
        (Yii::$app->session)['array'] = $query;
        $provider = new ArrayDataProvider([
            'allModels' => $query,
            'pagination' => false,
        ]);
        return $this->render('list-first-dishes', [
            'dataProvider' => $provider,
        ]);
    }

    public function actionExport1()
    {
        $list = (Yii::$app->session)['array'];
        $fileName = Yii::$app->request->get('title') . '.cvs';
        
        $fp = fopen(Yii::getAlias('@app') . '\export_file\\' . $fileName, 'w+');

        fputcsv($fp, $this->lable(array_keys($list[0])), ';');
        foreach ($list as $fields) {
            fputcsv($fp, $fields, ';');
        }

        fclose($fp);

        $filePath = Yii::getAlias('@app') . '\export_file\\' . $fileName;
        // $fileName = 'file.csv';

        $response = Yii::$app->response;
        $response->format = Response::FORMAT_RAW;
        $response->headers->add('Content-Type', 'text/csv');
        $response->headers->add('Content-Disposition', "attachment; filename=$fileName");

        $response->sendFile($filePath)->send();
    }

    public function actionExport2()
    {
        $list = (Yii::$app->session)['array'];
        $fileName = Yii::$app->request->get('title') . '.cvs';
        
        $text = implode(';', $this->lable(array_keys($list[0]))) . PHP_EOL;
        
        foreach ($list as $fields) {
            $text .= implode(';', $fields) . PHP_EOL;
        }

        $response = Yii::$app->response;

        $filePath = Yii::getAlias('@app') . '\export_file\\' . $fileName;

        $response->headers->add('Content-Type', 'text/csv');
        $response->headers->add('Content-Disposition', "attachment; filename=$fileName");

        $response->sendContentAsFile($text, $fileName)->send();
    }

    public function lable($array)
    {
        $lable = [
            'dishes_title' => 'Название блюда',
            'products_title' => 'Название продукта',
            'category' => 'Категория продукта',
            'pre_processing' => 'Предварительная обработка продутка',
            'count_spices' => 'Количество пряных продуктов',
            'dishes_category' => 'Категория блюда',
            'priority' => 'Очередь добавления',
            'calorie' => 'Калорийность'
        ];

        foreach ($array as $key => $val) {
            foreach ($lable as $key2 => $val2) {
                if ($val == $key2) {
                    $array[$key] = $val2;
                    continue;
                }
            }
        }

        return $array;
    }
}
