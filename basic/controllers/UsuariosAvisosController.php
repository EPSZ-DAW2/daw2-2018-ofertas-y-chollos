<?php

namespace app\controllers;

use Yii;
use app\models\UsuariosAviso;
use app\models\UsuariosAvisosSearch;
use app\models\Zonas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

/**
 * UsuariosAvisosController implements the CRUD actions for UsuariosAviso model.
 */
class UsuariosAvisosController extends Controller
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
                        'actions'=>['view','create','update','delete','moderar','limpieza'],
                        'roles'=>['moderador'],
                    ],
                    [
                        'allow'=>true,
                        'actions'=>['index'],
                        'roles'=>['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionLimpieza()
    {
        $model = new UsuariosAviso();
        if (!empty($_POST['UsuariosAviso'])) {
            //Eliminar Logs de la fecha
            $fecha=$_POST['UsuariosAviso']['fecha_limpieza'];
            if(!Yii::$app->user->can('admin'))
            {
                $ids_zona=$this->calcular_zona();
                $model->zona_busqueda=$ids_zona;
                $ids=$model->avisosModeracion;
                $ids_borrar=UsuariosAviso::find()->select('id')->where(['and',['<=', 'fecha_aviso', $fecha],['id'=>$ids]])->all();
            }
            else
            {
                $ids_borrar=UsuariosAviso::find()->select('id')->where(['<=', 'fecha_aviso', $fecha])->all();
            }

            foreach ($ids_borrar as $id)
            {
                $model=$this->findModel($id);
                $model->delete();
            }
            return $this->redirect(['moderar']);
        }
        return $this->render('limpieza', [
            'model' => $model,
        ]);
    }

    /**
     * Lists all UsuariosAviso models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosAvisosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsuariosAviso model.
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
     * Creates a new UsuariosAviso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UsuariosAviso();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UsuariosAviso model.
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

    public function calcular_zona()
    {
        $id_usuario=Yii::$app->user->id;
        $rows = (new \yii\db\Query())
            ->select('zona_id')
            ->from('usuarios_area_moderacion')
            ->all();

        foreach($rows as $aux)
        {
            $id_zona[]=$aux['zona_id'];
        }

        $zonas=array();
        foreach ($id_zona as $aux2)
        {
            $zona=zonas::find()->where(['id'=>$aux2])->one();
            $zonas[]=$zona;

            $aux=$zona->arbolHijos;
            foreach($aux as $zona)
            {
                $zonas[]=$zona;
            }

            $ids_zona=array();
            foreach ($zonas as $zona)
            {
                $ids_zona[]=$zona->id;
            }
        }
        return $ids_zona;
    }



    public function actionModerar()
    {
        if(!Yii::$app->user->can('admin'))
        {
            $ids_zona=$this->calcular_zona();
            $model=new UsuariosAviso();
            $model->zona_busqueda=$ids_zona;
            $ids=$model->avisosModeracion;
        }
        else
        {
            $ids=array();
        }

        $searchModel= new UsuariosAvisosSearch();
        $dataProvider= $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere([
            'usuarios_avisos.id'=>$ids,
        ]);
        $dataProvider->pagination->pageSize=25;

        /*$query = UsuariosAviso::find();

        $query->

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 6]
        ]);*/

        

        return $this->render('mantenimiento_moderador', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    
    }

    /**
     * Deletes an existing UsuariosAviso model.
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
     * Finds the UsuariosAviso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return UsuariosAviso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsuariosAviso::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }



}
