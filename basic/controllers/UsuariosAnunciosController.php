<?php

namespace app\controllers;

use Yii;
use app\models\UsuariosAnuncios;
use app\models\UsuariosAnunciosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuariosAnunciosController implements the CRUD actions for UsuariosAnuncios model.
 */
class UsuariosAnunciosController extends Controller
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
     * Lists all UsuariosAnuncios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosAnunciosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsuariosAnuncios model.
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
     * Creates a new UsuariosAnuncios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UsuariosAnuncios();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    //seguimiento usuario-anuncio
        public function actionSeguir($anuncio_id)
    {
        $model = new UsuariosAnuncios();
        $model->usuario_id=Yii::$app->user->identity->id;
        $model->anuncio_id=$anuncio_id;
        $model->fecha_seguimiento=date('Y-m-d H:i:s');
        $model->save(false);

       return $this->redirect(['anuncios/view', 'id' => $anuncio_id]);
    }

    /**
     * Updates an existing UsuariosAnuncios model.
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
     * Deletes an existing UsuariosAnuncios model.
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
    public function actionFinseguimiento($id)
    {
        $model=$this->findModel($id);
        $anuncio_id=$model->anuncio_id;
        $model->delete();

       return $this->redirect(['anuncios/view', 'id' => $anuncio_id]);
    }
    /**
     * Finds the UsuariosAnuncios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return UsuariosAnuncios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsuariosAnuncios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
