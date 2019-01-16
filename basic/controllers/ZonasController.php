<?php

namespace app\controllers;

use Yii;
use app\models\zonas;
use app\models\zonasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ZonasController implements the CRUD actions for zonas model.
 */
class ZonasController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'actions'=>['index','view','create','update','delete', 'parte2'],
                        'roles'=>['admin'],
                    ],
                    [
                        'allow'=>true,
                        'actions'=>['busqueda'],
                        'roles'=>['invitado'],
                    ]
                ],
            ],
        ];
    }

    public function actionBuscar_zona()
    {
        
    }

    public function actionBusqueda()
    {
        return $this->render('busqueda', [
            'model'=> new Zonas,
        ]);
    }
    public function codigo_a_texto($codigo){
        return $this::$zonas[$codigo];

    }
    public function texto_a_codigo($texto){
        return array_search($texto, $this::$zonas);
    }

    /**
     * Lists all zonas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new zonasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'clasesZona' => Zonas::$zonas,
        ]);
    }

    /**
     * Displays a single zonas model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new zonas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new zonas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing zonas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionParte2($id=null){
  //      echo $_POST["Tipo"];
        if($id!=null) $model = $this->findModel($id);
        else $model = new zonas();
        $model->clase_zona_id=$_POST["Tipo"];
        return $this->renderPartial('_form2', [
        'model' => $model,
    ]);
    }

    /**
     * Deletes an existing zonas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the zonas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return zonas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = zonas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}