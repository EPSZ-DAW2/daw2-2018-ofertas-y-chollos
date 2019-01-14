<?php

namespace app\controllers;

use Yii;
use app\models\Mensaje;
use app\models\MensajesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MensajesController implements the CRUD actions for Mensaje model.
 */
class MensajesController extends Controller
{
    public $fecha_limpieza;
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

    public function actionLimpieza()
    {
        $model = new Mensaje();
        if (!empty($_POST['Mensaje'])) {
            //Eliminar Logs de la fecha
            $fecha=$_POST['Mensaje']['fecha_limpieza'];

            $ids_borrar=mensaje::find()->select('id')->where(['<=', 'fecha_hora', $fecha])->all();
            foreach ($ids_borrar as $id)
            {
                $model=$this->findModel($id);
                $model->delete();
            }
            return $this->redirect(['index']);
        }
        return $this->render('limpieza', [
            'model' => $model,
        ]);
    }

    public function actionEnviar()
    {
        $model=new Mensaje();
        /*$model->texto=$texto;
        $model->origen_usuario_id=$origen;
        $model->destino_usuario_id=$destino;*/
        $model->load(Yii::$app->request->post());
        $model->fecha_hora=date("Y-m-d H:i:s");
        $model->save();
        $_SESSION['mensajes'][$model->destino_usuario_id][]=$model;
        return $this->render('chat', [
            'mensajes'=>$_SESSION['mensajes'][$model->destino_usuario_id],
            'model'=>new Mensaje(),
        ]);
    }

    public function actionListar()
    {
        $model=new Mensaje();
        $id_origen=Yii::$app->user->id;
        $model->destino_usuario_id=$id_origen;
        return $this->render('listar', [
            'lista'=>$model->lista
        ]);
    }

    public function actionActualizar($id_destino=null)
    {
        $model=new Mensaje();
        $id_origen=Yii::$app->user->id;
        $model->origen_usuario_id=$id_origen;
        $model->destino_usuario_id=$id_destino;
        $mensajes=$model->mensajes;
        foreach($mensajes as $mensaje)
        {
            $_SESSION['mensajes'][$id_destino][]=$mensaje;
            $mensaje->delete();
        }
    }

    //Función que iniciará el chat entre dos usuarios
    public function actionIniciar($id_destino=null)
    {
        $this->actionActualizar($id_destino);
        return $this->render('chat', [
            'mensajes'=>$_SESSION['mensajes'][$id_destino],
            'model'=>new Mensaje(),
        ]);
        /*if(isset($_SESSION['mensajes'][$id_destino]))
        {
            foreach ($_SESSION['mensajes'][$id_destino] as $mensaje)
            {
                echo $mensaje->fecha_hora.' '.$mensaje->texto.'<br>';
                //echo $mensaje->nick;
            }
        }*/
    }

    /**
     * Lists all Mensaje models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MensajesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mensaje model.
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
     * Creates a new Mensaje model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mensaje();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Mensaje model.
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
     * Deletes an existing Mensaje model.
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
     * Finds the Mensaje model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Mensaje the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mensaje::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
