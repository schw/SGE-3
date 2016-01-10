<?php

namespace app\controllers;

use Yii;
use app\models\Local;
use app\models\LocalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\base\Exception;

/**
 * LocalController implements the CRUD actions for Local model.
 */
class LocalController extends Controller
{
	public $lat;
	public $lng;
	
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
     * Lists all Local models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->autorizaUsuario();
        $searchModel = new LocalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndex2()
    {
    	$searchModel = new LocalSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
    	return $this->renderPartial('index2', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	]);
    }
    /**
     * Displays a single Local model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->autorizaUsuario();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionView2($id)
    {
    	return $this->renderPartial('view2', [
    			'model' => $this->findModel($id),
    	]);
    }

    /**
     * Creates a new Local model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	$this->autorizaUsuario();
        $model = new Local();
    	if(isset($_GET['lat']) && isset($_GET['lng']) && $_GET['nome']){
    		$model->latitude = $_GET['lat'];
    		$model->longitude = $_GET['lng'];
    		$model->descricao = $_GET['nome'];
    		$model->save();
    		$this->mensagens('success', 'Local Criado', 'Local foi Criado com Sucesso.');
    		
    		$this->redirect(['index2']);
    	}
        return $this->render('create',['model' => $model]);
    }

    /**
     * Updates an existing Local model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->autorizaUsuario();
        $model = $this->findModel($id);
        if(isset($_GET['lat']) && isset($_GET['lng']) && $_GET['nome']){
        	$model->latitude = $_GET['lat'];
        	$model->longitude = $_GET['lng'];
        	$model->descricao = $_GET['nome'];
        	$model->save();
        	$this->mensagens('success', 'Local Atualizado', 'Local foi Atualizado com Sucesso.');
        	return $this->redirect(['index2']);
        }
            return $this->render('update', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing Local model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	$this->autorizaUsuario();
        try{
        	$this->findModel($id)->delete();
        	$this->mensagens('success', 'Local Removido', 'Local foi removido com Sucesso.');
    	}catch(Exception $e){
    		$this->mensagens('danger', 'Local não Removido', 'Local selecionado está em uso por um evento ou item de programação.');
    	}

        return $this->redirect(['index']);
    }

    /**
     * Finds the Local model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Local the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Local::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function autorizaUsuario(){
        if(Yii::$app->user->isGuest || Yii::$app->user->identity->tipoUsuario == 3){
            throw new ForbiddenHttpException('Acesso Negado!! Recurso disponível apenas para administradores.');
        }
    }

    /* Envio de mensagens para views
    Tipo: success, danger, warning*/
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
