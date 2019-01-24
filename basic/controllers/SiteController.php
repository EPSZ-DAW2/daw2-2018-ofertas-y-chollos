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
    public function actionIndex($nPages=24, $filtro=null, $id_zona=null, $id_categoria=null, $id_etiqueta=null)
    {
        
		//filtros
		if($filtro===null && $id_zona===null && $id_categoria===null)
		{
			$query = Anuncio::find()->nuevos();
		}
		if($filtro == 'pop') {
			$query = Anuncio::find()->populares();
		}
		if($filtro == 'rec') {
			$query = Anuncio::find()->proximos();
		}
		$anuncio = Yii::$app->request->get('Anuncio');
		if($anuncio != null){
			$query = Anuncio::find()->busqueda($anuncio['titulo']);
		}
		if($id_zona !== null) {
			$query = Anuncio::find()->zonas($id_zona);
		}
		if($id_categoria !== null) {
			$query = Anuncio::find()->categorias($id_categoria);
		}
		if($id_etiqueta !== null) {
			$query = Anuncio::find()->etiquetas($id_etiqueta);
		
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
