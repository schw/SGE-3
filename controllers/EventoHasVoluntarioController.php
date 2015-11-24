<?php

namespace app\controllers;

use Yii;
use app\models\EventoHasVoluntario;
use app\models\EventoHasVoluntarioSearch;
use app\models\EventoSearch;
use app\models\Evento;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\db\IntegrityException;
use yii\base\Exception;

/**
 * EventoHasVoluntarioController implements the CRUD actions for EventoHasVoluntario model.
 */
class EventoHasVoluntarioController extends Controller
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
     * Lists all EventoHasVoluntario models.
     * @return mixed
     */
    public function actionIndex($idevento)
    {
        $searchModel = new EventoHasVoluntarioSearch();
        $dataProvider = $searchModel->search($idevento);
        $evento['descricao'] = Evento::findOne($idevento)->descricao;
        $evento['id'] = $idevento;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'evento' => $evento,
        ]);
    }

    /**
     * Displays a single EventoHasVoluntario model.
     * @param string $evento_idevento
     * @param integer $voluntario_idvoluntario
     * @return mixed
     */
    public function actionView($evento_idevento, $voluntario_idvoluntario)
    {
        return $this->render('view', [
            'model' => $this->findModel($evento_idevento, $voluntario_idvoluntario),
        ]);
    }

    /**
     * Creates a new EventoHasVoluntario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EventoHasVoluntario();
        $searchModel = new EventoHasVoluntarioSearch();

        $arrayVoluntarios = ArrayHelper::map($searchModel->searchVoluntarios()->getModels(), 'idvoluntario', 'nome');
        //$arrayEventosAtivos =  ArrayHelper::map((new EventoSearch())->searchEventosResponsavel('ativo')->getModels(), 'idevento', 'descricao');
        $idevento = filter_input(INPUT_GET, 'idevento');
        $model->evento_idevento = $idevento;

        if ($model->load(Yii::$app->request->post())) {
            try{
                $model->save();
                $this->mensagens('success', 'Voluntário Adicionado', 'O Voluntário '.$model->voluntario->nome.' foi adicionado com Sucesso');
            }catch(IntegrityException $e){
                $this->mensagens('warning', 'Voluntário já Adicionado', 'O Voluntário '.$model->voluntario->nome.' já adicionado ao evento');
            }catch(Exception $e){
                $this->mensagens('danger', 'Voluntário Não Adicionado', 'Erro: O Voluntário '.$model->voluntario->nome.' não foi adicionado');
            }finally{
                return $this->redirect(['index', 'idevento' => $model->evento_idevento]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'arrayVoluntarios' => $arrayVoluntarios,
            ]);
        }
    }

    /**
     * Updates an existing EventoHasVoluntario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $evento_idevento
     * @param integer $voluntario_idvoluntario
     * @return mixed
     */
    public function actionUpdate($evento_idevento, $voluntario_idvoluntario)
    {
        $model = $this->findModel($evento_idevento, $voluntario_idvoluntario);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'evento_idevento' => $model->evento_idevento, 'voluntario_idvoluntario' => $model->voluntario_idvoluntario]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EventoHasVoluntario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $evento_idevento
     * @param integer $voluntario_idvoluntario
     * @return mixed
     */
    public function actionDelete($evento_idevento, $voluntario_idvoluntario)
    {
        $this->autorizaUsuario();
        $model = $this->findModel($evento_idevento, $voluntario_idvoluntario);
        $voluntario = $model->voluntario->nome;
        if($model->delete()){
            $this->mensagens('success', 'Voluntário Removido', 'O Voluntário '.$voluntario.' foi removido com Sucesso');
        }else{
            $this->mensagens('danger', 'Voluntário não removido', 'O Voluntário'.$voluntario.' não pode ser removido deste evento');
        }

        return $this->redirect(['index', 'idevento' => $evento_idevento]);
    }

    /**
     * Finds the EventoHasVoluntario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $evento_idevento
     * @param integer $voluntario_idvoluntario
     * @return EventoHasVoluntario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($evento_idevento, $voluntario_idvoluntario)
    {
        if (($model = EventoHasVoluntario::findOne(['evento_idevento' => $evento_idevento, 'voluntario_idvoluntario' => $voluntario_idvoluntario])) !== null) {
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

    /*Tipo: sucess, danger, warning*/
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
