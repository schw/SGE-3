<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\db\IntegrityException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView()
    {
        $model = new User();
    	$id = Yii::$app->request->post('id');
        if(!$id){
            $this->autorizaUsuario($id);
            $id = Yii::$app->user->identity->idusuario;    
            //$model = User::findByEmail(Yii::$app->user->identity->email); 
        }
        	return $this->render('view', [
        			'model' => $this->findModel($id),
        	]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
        	if($model->save()){
        	  $this->mensagens('success', 'Cadastro realizado', 'Cadastro efetuado com Sucesso');
        	  return $this->redirect(['site/login']);
        	 }else{
        	    return $this->render('create', [
                'model' => $model,
                ]);
        	 }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	
	/**
	 * Updates an existing User model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * 
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$this->autorizaUsuario ( $id );
		$model = $this->findModel ( $id );
		if(Yii::$app->user->identity->idusuario === $model->idusuario){
		if ($model->load ( Yii::$app->request->post () ) ) {
			$model->senha = md5($model->senha);
			if($model->save(false)){
				return $this->redirect ( ['view', 'id' => $model->idusuario]);
				}
	        } else {
	            return $this->render('update', [
	                'model' => $model,
	            ]);
	        }
		}else{
			return $this->goBack();
		}
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->autorizaUsuario($id);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function autorizaUsuario($id){
        
        if(Yii::$app->user->isGuest){
            throw new ForbiddenHttpException('Acesso Negado!! Realize Login.');
        }

        /*if(Yii::$app->user->identity->idusuario != $id){
            throw new NotFoundHttpException("Erro: Id Inválido");
        }*/
    }
    
    /*Tipo: success, danger, warning*/
    protected function mensagens($tipo, $titulo, $mensagem){
        Yii::$app->session->setFlash($tipo, [
            'type' => $tipo,
            'duration' => 1200,
            'icon' => 'home',
            'message' => $mensagem,
            'title' => $titulo,
            'positonY' => 'bottom',
            'positonX' => 'right'
        ]);
    }
}
