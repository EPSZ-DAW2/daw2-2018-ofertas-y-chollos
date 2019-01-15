<?php

namespace app\controllers;

use Yii;
use app\models\Perfil;
use app\models\UsuariosAviso;
use app\models\Anuncio;
use app\models\PerfilSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

/**
 * PerfilController implements the CRUD actions for Perfil model.
 */
class PerfilController extends Controller
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
                        'actions'=>['index','view','create','update','delete', 'baja', 'pass', 'anuncios', 'avisos', 'seguidos'],
                        'roles'=>['usuario'],
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

    /**
     * Lists all Perfil models.
     * @return mixed
     */
    public function actionIndex()
    {
       return $this->render('index', [
            'model' => $this->findModel(Yii::$app->user->id),
        ]);
    }

    /**
     * Displays a single Perfil model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        return $this->render('view', [
            'model' => $this->findModel(Yii::$app->user->id),
        ]);
    }

    /**
     * Creates a new Perfil model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Perfil();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Perfil model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $model = $this->findModel(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Perfil model.
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
     * Finds the Perfil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Perfil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Perfil::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


       public function actionBaja(){
    //  $model = new UsuariosAviso/Create();
/*      $model = $this->actionCreate($id);
        
        if($model->load(Yii::$app->request->post()))
        {
            $id =  $model->id;
        }
*/      
    if (Yii::$app->request->post()) {
                $modelo = new UsuariosAviso();
                $modelo->fecha_aviso=date("y-m-d H:i:s");
                $modelo->clase_aviso_id='N';
                $modelo->texto='Baja';
                $modelo->origen_usuario_id=Yii::$app->user->id;
                if ( $modelo->save()) {
                return $this->redirect(['index']);
            }
            }else{
        $model = $this->findModel(Yii::$app->user->id);
       return $this->render('baja', [
            'model' => $model,
        ]);
}
    }

    public function actionPass(){
        $model = $this->findModel(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post())) {
            $model->password=md5($model->password2);
            if ( $model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('pass', [
            'model' => $model,
        ]);
    }

	public function actionAnuncios()
    {

        //preparamos la consulta...
        $query = Anuncio::find();
        //filtrar solo anuncios visibles...       
        $query->andFilterWhere([
            'bloqueada' => '0', 'crea_usuario_id'=>Yii::$app->user->id ]);
    
        //preparamos el proveedor de datos...
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 6]
        ]);

        return $this->render('anuncios', [
            'dataProvider' => $dataProvider,
        ]);
    
    }

    public function actionSeguidos()
    {
//JOSEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE AQUI TU CODIGOOOOOOOOOOOOOOOOOOOOOOO    
    }


    public function actionAvisos(){
        $query = UsuariosAviso::find();
        $query->andFilterWhere(['or',['destino_usuario_id'=> Yii::$app->user->id],['origen_usuario_id'=>Yii::$app->user->id]]);
                $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('avisos', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
