<?php

namespace app\controllers;

use Yii;
use app\models\Registro;
use app\models\RegistrosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * RegistrosController implements the CRUD actions for Registro model.
 */
class RegistrosController extends Controller
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

    public function limpieza_automatica()
    {
    	$fecha=date("Y-m-d H:i:s",time()-365*24*60*60);
    	echo $fecha;
        $ids_borrar=registro::find()->select('id')->where(['<=', 'fecha_registro', $fecha])->all();
        foreach ($ids_borrar as $id)
        {
            $model=$this->findModel($id);
            $model->delete();
        }
    }

    /**
     * Lists all Registro models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RegistrosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->limpieza_automatica();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Registro model.
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


    public function actionLimpieza()
    {
        $model = new Registro();
        if (!empty($_POST['Registro'])) {
            //Eliminar Logs de la fecha
            $fecha=$_POST['Registro']['fecha_limpieza'];

            $ids_borrar=registro::find()->select('id')->where(['<=', 'fecha_registro', $fecha])->all();
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

    /**
     * Creates a new Registro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Registro();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Registro model.
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
     * Deletes an existing Registro model.
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

    public function actionExportar()
    {
        $registros=registro::find()->all();

         $nombre_archivo = "logs".date("d-m-Y|H:i:s").".txt"; 

         
        $archivo="";
        //$archivo=fopen("log.txt","w");

        foreach ($registros as $registro)
        {

            $mensaje=$registro->fecha_registro." | ".$registro->clase_log_id." | ".$registro->modulo." | ".$registro->texto." | ".$registro->ip." | ".$registro->browser.";";

                $mensaje=$mensaje."\n";
                //fwrite($archivo, $mensaje);
                $archivo=$archivo.$mensaje;


        }


           

            //$size=filesize('log.txt');
            header("Content-Type: application/force-download");
            header("Content-Disposition: attachment; filename=".$nombre_archivo);
            header("Content-Transfer-Encoding: binary");
            //header("Content-Lenght".$size);
            echo $archivo;
            //readfile('log.txt');
            //return true;
            //return $this->redirect(['index']);


    }

    /**
     * Finds the Registro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Registro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Registro::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
