<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\UsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use yii\data\ActiveDataProvider;

/**
 * UsuariosController implements the CRUD actions for Usuario model.
 */
class UsuariosController extends Controller
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
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Usuario models.
     * ORDENADOS POR FECHA
     */
    public function actionRevision_registro()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->setSort([
        'attributes' => [
            'fecha_registro' => [
                'asc' => ['fecha_registro' => SORT_ASC],
                'desc' => ['fecha_registro' => SORT_DESC],
                'default' => SORT_ASC
            ],
        ],
        'defaultOrder' => [
            'fecha_registro' => SORT_DESC
        ]
    ]);



        return $this->render('revision_registro', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /*Accion de prueba para la vista de las piezas resumidas usuario
    En query se le pasa la consulta que se necesite, en este caso todos los usuarios
    --A listar_usuarios es obligatorio pasarle un objeto dataProvider
    --pageSize es el tamaño de pagina
    */
    public function actionListar()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Usuario::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('listar_usuarios', [
            'dataProvider' => $dataProvider,
        ]);

    }

    //muestra todos los usuarios y su rol correspondiente para modificarlos
    public function actionRoles()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin_roles', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    //cambia el rol del usuario, se viene aqui desde la pantalla de administrar roles
    public function actionAdmin($id, $opcion, $rol)
    {
        //Se crea un array con los roles para ascender o descender mas facilmente 
        $roles= array("usuario" , "moderador", "admin", "sysadmin" );
        switch ($rol) //se calcula el índice en el que esta el rol actual
        {
            case 'usuario':
                $idrol=0;
                break;
            case 'moderador':
                $idrol=1;
                break;
            case 'admin':
                $idrol=2;
                break;
            case 'sysadmin':
                $idrol=3;
                break;

            case 'patrocinador':
             //SI EL USUARIO ERA PROVEEDOR BORRAR SUS DATOS DE LA TABLA CORRESPONDIENTE

                Yii::$app->db->createCommand("DELETE FROM proveedores WHERE usuario_id = '$id' ")->execute();
                if ($opcion=='ascender') $idrol=1;
                else if ($opcion=='degradar') $idrol=2;
                break;
        }


        $auth = Yii::$app->authManager;
        
        $auth->revokeAll($id);


        if ($opcion=='ascender') 
        {
            $authorRole = $auth->getRole($roles[$idrol+1]);
            $auth->assign($authorRole, $id);
        }
        else if ($opcion=='degradar')
        {
            $authorRole = $auth->getRole($roles[$idrol-1]);
            $auth->assign($authorRole, $id);

        }

         return $this->redirect(['usuarios/roles']);
    }


    /**
     * Displays a single Usuario model.
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

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    

    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuario();

        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Acción de registro de usuario.
     * Si el registro es correcto, se redirigirá a la pantalla de login.     
     */

    public function actionRegistro()
    {
        $model = new Usuario();

        if ($model->load(Yii::$app->request->post())) {

            //preparamos los datos recibidos para guardar en la base de datos, y añadimos los necesarios.

            //hashear password
            $model->password=md5($model->password);
            $model->password2=md5($model->password2);

            //convertir fecha nacimiento           
            $fecha_aux = str_replace('/', '-', $model->fecha_nacimiento);            
            $model->fecha_nacimiento=date('Y-m-d', strtotime($fecha_aux));

            //obtener fecha actual
            $model->fecha_registro=date("Y-m-d H:i:s");

            //inicializar otros campos...
            $model->num_accesos="0";
            $model->bloqueado="0";
            $model->confirmado="0";

            if($model->save()){

                //asignamos el rol usuario
                $auth = Yii::$app->authManager;
                $authorRole = $auth->getRole('usuario');
                $auth->assign($authorRole, $model->id);

                return $this->redirect(['confirmar', 'id' => $model->id]);
            }
        }

        return $this->render('registro', [
            'model' => $model,
        ]);

    }

    /**
     * Acción de confirmación del usuario, marca al usuario como confirmado en la base de datos. 
     */

    public function actionConfirmar($id)
    {
        $model = new Usuario();
        if (Yii::$app->request->get("confirmar")) 
        {
            $model = Usuario::findOne($id);
            $model->confirmado="1";
            //si se recibe confirmar, modificarlo y redirigir a id
            Yii::$app->db->createCommand("UPDATE usuarios SET confirmado=1 WHERE id = '$id' ")->execute();
           return $this->redirect(['login', 'id' => $id]);
        }
        return $this->render('confirmar', [
            'model' => $this->findModel($id),
        ]);
    }

    

    /**
     * Acción de login de usuario.  
     */

    public function actionLogin()
    {
               
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            //registrar la fecha de acceso en la base de datos y reiniciar el contador de accesos...
            $usuario = Usuario::findOne(['id' => Yii::$app->user->id]);
            $usuario->updateAttributes(['fecha_acceso' => date("Y-m-d H:i:s"),'num_accesos' => 0]);            
            
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing Usuario model.
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
     * Deletes an existing Usuario model.
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
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
