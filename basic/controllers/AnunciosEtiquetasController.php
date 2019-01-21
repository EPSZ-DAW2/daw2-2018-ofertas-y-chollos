<?php

namespace app\controllers;

use Yii;
use app\models\AnunciosEtiquetas;
use app\models\Etiqueta;
use app\models\AnunciosEtiquetasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnunciosEtiquetasController implements the CRUD actions for AnunciosEtiquetas model.
 */
class AnunciosEtiquetasController extends Controller
{
    /**
     * {@inheritdoc}
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
        ];
    }

    /**
     * Lists all AnunciosEtiquetas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnunciosEtiquetasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnunciosEtiquetas model.
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
     * Creates a new AnunciosEtiquetas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnunciosEtiquetas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AnunciosEtiquetas model.
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

    /**
     * Deletes an existing AnunciosEtiquetas model.
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
    public function actionDesetiquetar($id)
    {
        $model = $this->findModel($id);
        $anuncio_id= $model->anuncio_id;
        $model->delete();

        return $this->redirect(['anuncios/view','id'=>$anuncio_id]);
    }

    /**
     * Finds the AnunciosEtiquetas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AnunciosEtiquetas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnunciosEtiquetas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }



    public function actionEtiquetar($anuncio_id)
    {
        $model = new AnunciosEtiquetas();
        $model->anuncio_id=$anuncio_id;
        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['anuncios/view', 'id' => $model->anuncio_id]);
        }

        return $this->render('etiquetar', [
            'model' => $model,
            'etiquetas'=>$this->listarEtiquetas($model->anuncio_id)
        ]);
    }

        protected function listarEtiquetas($anuncio_id)
    {
         $etiquetasTodas = Etiqueta::find()->all();
       $etiquetas = array();
        foreach ($etiquetasTodas as $etiqueta) {
        if( AnunciosEtiquetas::findOne(['anuncio_id'=>$anuncio_id,'etiqueta_id'=>$etiqueta->id]) == null)
           $etiquetas[$etiqueta->id]=$etiqueta->nombre;
        }
        return $etiquetas;
    }
    
}