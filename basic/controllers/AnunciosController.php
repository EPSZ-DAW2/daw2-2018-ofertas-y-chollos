<?php

namespace app\controllers;

use Yii;
use app\models\Anuncio;
use app\models\Categorias;
use app\models\Proveedor;
use app\models\Zonas;
use app\models\Anuncio_comentario;
use app\models\AnuncioSearch;
use app\models\Etiqueta;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\Anuncio_comentarioSearch;
use app\models\UsuariosAnuncios;
use app\models\AnunciosEtiquetas;

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
     public function actionIndexpublico()
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

    //vista detalle publica
    public function actionView($id)
    {



      $model = $this->findModel($id);
      if($model->terminada==0 && $model->bloqueada==0 && $model->visible==1)
      {
        $zona = Zonas::findOne($model->zona_id);
        $nombreZona = $zona==null ? " Sin zona asignada" : $zona->nombre;

        $categoria = Categorias::findOne($model->categoria_id);
        $nombreCategoria= $categoria==null ? " Sin zona asignada" : $categoria->nombre;

      // $comentarios = Anuncio_comentario::findAll(['anuncio_id'=>$model->id]);


      //  $comentarios = Anuncio_comentario::findAll(['anuncio_id'=>$model->id, 'bloqueado'=>0, 'cerrado'=>0]);
        $comentario = new Anuncio_comentario();
        if (!Yii::$app->user->isGuest && $comentario->load(Yii::$app->request->post())) {
      //$model->crea_usuario_id = Yii::$app->user->identity->id; //---------pendiente-------------
              $comentario->crea_usuario_id = Yii::$app->user->identity->id;
              $comentario->crea_fecha = date('Y-m-d H:i:s');
              $comentario->anuncio_id = $model->id;

              $comentario->save(false);
     // return $this->redirect(['comentarios']);
    } 


if(!Yii::$app->user->isGuest)
$seguimiento =  UsuariosAnuncios::findOne(['usuario_id' =>Yii::$app->user->identity->id, 'anuncio_id' => $model->id]);
else
  $seguimiento=null;



    $searchModel = new Anuncio_comentarioSearch();
    $dataProvider = $searchModel->search(['Anuncio_comentarioSearch'=>['anuncio_id' => $model->id,'cerrado'=>0, 'bloqueado' => '0']]);
    $dataProvider->setSort([
        'defaultOrder' => ['crea_fecha'=>SORT_DESC],
    ]);
          return $this->render('view', [
            'model' =>  $model,
            'zona' => $nombreZona,
            'categoria' => $nombreCategoria,
            'comentarios' => $dataProvider,
            'seguimiento' => $seguimiento,
            'etiquetas'=>$this->listarEtiquetas($model->id)
          ]);
      }else{
         return $this->redirect(['site/index']);
      }
      
    }
     public function actionViewadmin($id)
    {
        return $this->render('view_admin', [
            'model' => $model,
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
        // $model = $this->findModel($id);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {



           // return $this->redirect(['view', 'id' => $model->id]);
     //   }



        $result = $model->load(Yii::$app->request->post()) && $model->validate();
        if ($result) {
          if($model->texto != $model->oldAttributes['texto']) {
            //if(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity->id) == 'Administrador' ) 
              $model->modi_usuario_id = 0;
            //else
              //$model->modi_usuario_id = Yii::$app->user->identity->id;
            $model->modi_fecha = date('Y-m-d H:i:s');
          }
          if($model->bloqueada != $model->oldAttributes['bloqueada']) {
            if($model->bloqueada == 0){
              $model->fecha_bloqueo = '';
            } else if($model->fecha_bloqueo == ''){
              $model->fecha_bloqueo = date('Y-m-d H:i:s');
            }
          }
          if ($model->save(false)) {
            return $this->redirect(['view', 'id' => $model->id]);
          }


        $resulta = $model->load(Yii::$app->request->post()) && $model->validate();
        if ($resulta) {
          if($model->texto != $model->oldAttributes['texto']) {
            //if(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity->id) == 'Administrador' ) 
              $model->modi_usuario_id = 0;
            //else
              //$model->modi_usuario_id = Yii::$app->user->identity->id;
            $model->modi_fecha = date('Y-m-d H:i:s');
          }
          if($model->terminada != $model->oldAttributes['terminada']) {
            if($model->terminada == 0){
              $model->fecha_terminacion = '';
            } else if($model->fecha_terminacion == ''){
              $model->fecha_terminacion = date('Y-m-d H:i:s');
            }
          }
          if ($model->save(false)) {
            return $this->redirect(['view', 'id' => $model->id]);
          }



        return $this->render('update', [
            'model' => $model,
            'categorias' => $this->listarCategorias(),
             'proveedores' => $this->listarProveedores(),
        ]);
      }
    }
    }

    public function actionVotarok($id)
    {
        $model = $this->findModel($id);
        $model->votosOK = $model->votosOK+1;
        $model->save(false);
        return $this->redirect(['view', 'id' => $model->id]);
    
        
    }
      public function actionVotarko($id)
    {
        $model = $this->findModel($id);
        $model->votosKO++;
        $model->save(false);
        return $this->redirect(['view', 'id' => $model->id]);
        
    }
    public function actionDenunciar($id)
    {
       $model = $this->findModel($id);
        $model->num_denuncias++;
      

       if($model->num_denuncias >= Anuncio::maximoDenuncias()) {
        //CUANDO  SE ALCANCE UN Nº DE DENUNCIAS DETERMINADO SE DEBERÁ BLOQUEAR EL ANUNCIO PARA QUE NO SE VEA.  
        $model->bloqueada=1;
        $model->visible=0;  
      }
    $model->save(false);
        return $this->redirect(['view', 'id' => $model->id]);
        
    }

    //Realiza un seguimiento de un anuncio
    public function actionSeguir($id)
    {
       $model = $this->findModel($id);
        

    //$model->save(false);
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
         $listaCategorias = Categorias::find()->all();
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

     protected function listarEtiquetas($id)
    {
         $relaciones = AnunciosEtiquetas::findAll(['anuncio_id'=>$id]);
       $etiquetas = array();
        foreach ($relaciones as $relacion) {
        
           $etiquetas[$relacion->id]=Etiqueta::findOne($relacion->etiqueta_id)->nombre;
        }
        return $etiquetas;
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


    public function actionListar_zona($id_zona){

        $zonas=array();
        $zona=zonas::find()->where(['id'=>$id_zona])->one();
        $zonas[]=$zona;

        $aux=$zona->arbolHijos;
        foreach($aux as $zona)
        {
            $zonas[]=$zona;
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
    
        //preparamos el proveedor de datos...
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 6]
        ]);

        return $this->render('listar_anuncios', [
            'dataProvider' => $dataProvider,
        ]);
    }



//Función para bloqueo de anuncios. Recibe lista de bloqueos
public function actionBloquear($id, $tipo=null, $url=null)
    {
        $model = $this->findModel($id);
    
    if($tipo !== null) {
      $model->fecha_bloqueo = date('Y-m-d H:i:s');
      $model->bloqueada == $tipo;
      if ($model->save(false)) {
        //Grupo 2 poned aquí la dirección a la que tiene que volver, pasais otro parametro como el de tipo con lo que os haga falta para regresar
        return $this->redirect([$url]);
      } else {
        //Grupo 2 poned aquí la dirección a la que tiene que volver, pasais otro parametro como el de tipo con lo que os haga falta para regresar
        return $this->redirect([$url]);
      }
    }

    $result = $model->load(Yii::$app->request->post());
    if ($result) {
      if($model->bloqueada != $model->oldAttributes['bloqueada']) {
        if($model->bloqueada == 0){
          $model->fecha_bloqueo = '';
        } else if($model->fecha_bloqueo == ''){
          $model->fecha_bloqueo = date('Y-m-d H:i:s');
        }
      }
      if ($model->save(false)) {
        return $this->redirect(['view', 'id' => $model->id]);
      }
        }

        return $this->render('bloquear', [
            'model' => $model,
        ]);
    }

//Función para bloqueo de anuncios. Recibe lista de terminación
public function actionTerminar($id, $tipo=null, $url=null)
    {
        $model = $this->findModel($id);
    
    if($tipo !== null) {
      $model->fecha_terminacion = date('Y-m-d H:i:s');
      $model->terminada == $tipo;
      if ($model->save(false)) {
        //Grupo 2 poned aquí la dirección a la que tiene que volver, pasais otro parametro como el de tipo con lo que os haga falta para regresar
        return $this->redirect([$url]);
      } else {
        //Grupo 2 poned aquí la dirección a la que tiene que volver, pasais otro parametro como el de tipo con lo que os haga falta para regresar
        return $this->redirect([$url]);
      }
    }

    $resulta = $model->load(Yii::$app->request->post());
    if ($resulta) {
      if($model->terminada != $model->oldAttributes['terminada']) {
        if($model->terminada == 0){
          $model->fecha_terminacion = '';
        } else if($model->fecha_terminacion == ''){
          $model->fecha_terminacion = date('Y-m-d H:i:s');
        }
      }
      if ($model->save(false)) {
        return $this->redirect(['view', 'id' => $model->id]);
      }
        }

        return $this->render('terminar', [
            'model' => $model,
        ]);
    }





}
