<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Anuncio;
use app\models\AnuncioSearch;
use yii\data\ActiveDataProvider;

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
    public function actionIndex($nPages=2, $filtro=null)
    {
        
		//filtros
		if($filtro===null)
		{
			$query = Anuncio::find();
			$query->andFilterWhere([
				'visible' => '1',
				'bloqueada' => 0,
			]);
		}
		if($filtro == 'rec')
		{
			$query = Anuncio::find();
			$query->andFilterWhere([
				'visible' => '1',
				'bloqueada' => 0,
				
			]);
		}
		
		
		//paginador
		if($nPages !== 1)
		{
			//preparamos el proveedor de datos...
			$dataProvider = new ActiveDataProvider([
				'query' => $query,
				'pagination' => ['pageSize' => $nPages],
			]);
		} 
		else 
		{
			//preparamos el proveedor de datos...
			$dataProvider = new ActiveDataProvider([
				'query' => $query,
				'pagination' => false,
			]);
		}
		
		if($filtro == null) {
			$dataProvider->setSort([
				'defaultOrder' => [
					'prioridad'=>SORT_DESC,
					'id'=>SORT_DESC
				],
			]);
		}
		if($filtro == 'pop') {
			$dataProvider->setSort([
				'defaultOrder' => [
					'votosOK'=>SORT_DESC,
				],
			]);
		}
		if($filtro == 'rec') {
			$dataProvider->setSort([
				'defaultOrder' => [
					'fecha_desde'=>SORT_DESC,
				],
			]);
		}
		

		
		
		
		return $this->render('index', [
            'dataProvider' => $dataProvider,
			'nPages' => $nPages,
        ]);
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
}
