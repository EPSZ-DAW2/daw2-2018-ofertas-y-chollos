<?php

namespace app\controllers;

use Yii;
use app\models\Anuncio;
use app\models\Categoria;
use app\models\Proveedor;
use app\models\Zonas;
use app\models\AnuncioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * AnunciosController implements the CRUD actions for Anuncio model.
 */
class AnunciosController extends Controller
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
     * Lists all Anuncio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnuncioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
     public function actionIndexPublico()
    {
        $searchModel = new AnuncioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index_publico', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Anuncio model.
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
     public function actionViewadmin($id)
    {
        return $this->render('view_admin', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Anuncio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Anuncio();

        
       

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'categorias' => $this->listarCategorias(),
            'proveedores' => $this->listarProveedores(),
        ]);
    }

    /**
     * Updates an existing Anuncio model.
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
            'categorias' => $this->listarCategorias(),
             'proveedores' => $this->listarProveedores(),
        ]);
    }

    public function actionVotarok($id)
    {
        $model = $this->findModel($id);
        $model->votosOK = $model->votosOK+1;
      
        return $this->redirect(['view', 'id' => $model->id]);
    
        
    }
      public function actionVotarko($id)
    {
        $model = $this->findModel($id);
        $model->votosKO++;
       $model->save();
        return $this->redirect(['view', 'id' => $model->id]);
        
    }
    public function actionDenunciar($id)
    {
       $model = $this->findModel($id);
        $model->num_denuncias++;
       $model->save();
        return $this->redirect(['view', 'id' => $model->id]);
        
    }

    /**
     * Deletes an existing Anuncio model.
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
     * Finds the Anuncio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Anuncio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Anuncio::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function listarCategorias()
    {
         $listaCategorias = Categoria::find()->all();
       $categorias = array(0=>"Ninguna");
        foreach ($listaCategorias as $categoria) {
           $categorias[$categoria->id]=$categoria->nombre;
        }
        return $categorias;
    }
    protected function listarProveedores()
    {
         $lp = Proveedor::find()->all();
       $ps = array(0=>"Ninguno");
        foreach ($lp as $p) {
           $ps[$p->id]=$p->razon_social;
        }
        return $ps;
    }

    //acción para listar todos los anuncios, a excepcion de los no visibles y los bloqueados    

    public function actionListar(){

        //preparamos la consulta...
        $query = Anuncio::find();
        //filtrar solo anuncios visibles...       
        $query->andFilterWhere([
            'visible' => '1','bloqueada' => '0']);
    
        //preparamos el proveedor de datos...
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 6]
        ]);

        return $this->render('listar_anuncios', [
            'dataProvider' => $dataProvider,
        ]);
    }

     public function hijos($hijo)
    {
        $hijos=$hijo->hijos;
        foreach($hijos as $hijo)
        {
            $aux=$this->hijos($hijo);
            foreach ($aux as $zona)
            {
                $hijos[]=$zona;
            }
        }
        return $hijos;
    }

    public function actionListar_zona($id_zona){

        $zonas=array();
        $zona=zonas::find()->where(['id'=>$id_zona])->one();

        $hijos=$zona->hijos;
        $zonas[]=$zona;

        foreach ($hijos as $hijo)
        {
            $zonas[]=$hijo;
            $aux=$this->hijos($hijo);
            foreach($aux as $zona)
            {
                $zonas[]=$zona;
            }
        }
        $ids=array();
        foreach ($zonas as $zona)
        {
            $ids[]=$zona->id;
        }

        //preparamos la consulta...
        $query = Anuncio::find();
        //filtrar solo anuncios visibles...
        //to-do: filtrar tambien ofertas bloqueadas...
        $query->andFilterWhere([
            'visible' => '1',
            'zona_id' => $ids,
        ]);

        /*$query = (new \yii\db\Query())
        ->select('*')
        ->from('anuncios')
        ->where([
        'visible' => '1',
        'zona_id' => $ids])
        ->all();*/

        //echo "<pre>"; print_r($query); echo "</pre>";
    
        //preparamos el proveedor de datos...
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 6]
        ]);

        return $this->render('listar_anuncios', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
