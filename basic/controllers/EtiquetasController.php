<?php

namespace app\controllers;

use Yii;
use app\models\Etiqueta;
use app\models\EtiquetasSearch;
use app\models\Anuncio;
use app\models\AnunciosEtiquetas;
use app\models\UsuariosEtiquetas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EtiquetasController implements the CRUD actions for Etiqueta model.
 */
class EtiquetasController extends Controller
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
     * Lists all Etiqueta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EtiquetasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Etiqueta model.
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
     * Creates a new Etiqueta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Etiqueta();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Etiqueta model.
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
     * Deletes an existing Etiqueta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
	 
	 public function actionUnificacion()
    {
         $model = new Etiqueta();//usamos un modelo de etiquetas pero no guardaremos una etiqueta sino dos ids de etiqueta

        if ($model->load(Yii::$app->request->post())) {
			$idEliminar = $model->descripcion;
			$idConservar = $model->nombre;//el atributo nombre en esta ocasion nos servirá para guardar el id de la otra categoria
			if($idEliminar != $idConservar)
			{
				UsuariosEtiquetas::updateAll(['etiqueta_id' => $idConservar], 'etiqueta_id = '.$idEliminar);
				AnunciosEtiquetas::updateAll(['etiqueta_id' => $idConservar], 'etiqueta_id = '.$idEliminar);		
				$this->findModel($idEliminar)->delete();
			}
			
            return $this->redirect(['index']);
        }
		$listaDeEtiquetas = Etiqueta::find()->all();
		$listaDeNombres = array();
		foreach($listaDeEtiquetas as $etiqueta)
		{
			$listaDeNombres[$etiqueta->id]=$etiqueta->nombre;
		}
        return $this->render('unificacion', [
            'model' => $model,
			'listaDeEtiquetas' => $listaDeNombres,
        ]);
    }
	 
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Etiqueta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Etiqueta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Etiqueta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
