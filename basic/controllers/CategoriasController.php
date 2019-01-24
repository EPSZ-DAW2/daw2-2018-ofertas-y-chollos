<?php

namespace app\controllers;

use Yii;
use app\models\Categorias;
use app\models\Anuncio;
use app\models\UsuariosCategorias;
use app\models\CategoriasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoriaController implements the CRUD actions for Categoria model.
 */
class CategoriasController extends Controller
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
     * Lists all Categoria models.
     * @return mixed
     */
	 
	public function actionBusqueda()
    {
        return $this->render('busqueda', [
            'model'=> new Categorias,
        ]);
    }
	 
    public function actionIndex()
    {
        $searchModel = new CategoriasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categoria model.
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
     * Creates a new Categoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categorias();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Categoria model.
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
  public function actionUnificacion()
    {
         $model = new Categorias();//usamos un modelo de categoria pero no guardaremos una categoria sino dos ids de categoria

        if ($model->load(Yii::$app->request->post())) {
			$idEliminar = $model->categoria_id;
			$idConservar = $model->nombre;//el atributo nombre en esta ocasion nos servirá para guardar el id de la otra categoria
			if($idEliminar != $idConservar)
			{
				Anuncio::updateAll(['categoria_id' => $idConservar], 'categoria_id = '.$idEliminar);
				UsuariosCategorias::updateAll(['categoria_id' => $idConservar], 'categoria_id = '.$idEliminar);
				$this->findModel($idEliminar)->delete();
			}
			
            return $this->redirect(['index']);
        }
		$listaDeCategorias = Categorias::find()->all();
		$listaDeNombres = array();
		foreach($listaDeCategorias as $categoria)
		{
			$listaDeNombres[$categoria->id]=$categoria->nombre;
		}
        return $this->render('unificacion', [
            'model' => $model,
			'listaDeCategorias' => $listaDeNombres,
        ]);
    }
    /**
     * Deletes an existing Categoria model.
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
     * Finds the Categoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Categoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categorias::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
