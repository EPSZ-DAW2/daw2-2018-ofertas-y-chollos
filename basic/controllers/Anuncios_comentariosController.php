<?php

namespace app\controllers;

use Yii;
use app\models\Anuncio_comentario;
use app\models\Anuncio_comentarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Anuncios_comentariosController implements the CRUD actions for Anuncio_comentario model.
 */
class Anuncios_comentariosController extends Controller
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
        ];
    }

    /**
     * Lists all Anuncio_comentario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Anuncio_comentarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Anuncio_comentario model.
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
     * Creates a new Anuncio_comentario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Anuncio_comentario();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Anuncio_comentario model.
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
     * Deletes an existing Anuncio_comentario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $page=null)
    {
        $this->findModel($id)->delete();

        if($page!==null)
					return $this->redirect([$page]);
				else
					return $this->redirect(['index']);
    }

    /**
     * Finds the Anuncio_comentario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Anuncio_comentario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Anuncio_comentario::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
		
		
	public function actionComentarios()
	{
		$model = new Anuncio_comentario();
		
		//id oferta
		$id = 1;
		
		if ($model->load(Yii::$app->request->post())) {
			//$model->crea_usuario_id = Yii::$app->user->identity->id; //---------pendiente-------------
			$model->crea_usuario_id = 43;
			$model->crea_fecha = date('Y-m-d H:i:s');
			$model->save(false);
			return $this->redirect(['comentarios']);
		}
		
		$searchModel = new Anuncio_comentarioSearch();
		$dataProvider = $searchModel->search(['Anuncio_comentarioSearch'=>['anuncio_id' => $id, 'bloqueado' => '0']]);
		$dataProvider->setSort([
        'defaultOrder' => ['id'=>SORT_DESC],
		]);
		
		return $this->render('comentarios', [
				'dataProvider' => $dataProvider,
				'model' => $model,
		]);

	}
	
	public function actionDenunciar($id)
	{
		$model = $this->findModel($id);
		$model->num_denuncias = $model->num_denuncias+1;
		if ($model->fecha_denuncia1 === null) $model->fecha_denuncia1 = date('Y-m-d H:i:s');
		$model->save(false);
		
		return $this->redirect(['comentarios']);
	}
}
