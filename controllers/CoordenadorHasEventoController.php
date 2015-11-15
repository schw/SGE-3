<?php

namespace app\controllers;

use Yii;
use app\models\CoordenadorHasEvento;
use app\models\CoordenadorHasEventoSearch;
use app\models\EventoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\db\IntegrityException;
use yii\base\Exception;

/**
 * CoordenadorHasEventoController implements the CRUD actions for CoordenadorHasEvento model.
 */
class CoordenadorHasEventoController extends Controller
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
     * Lists all CoordenadorHasEvento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $idevento = Yii::$app->request->queryParams['idevento'];
        $searchModel = new CoordenadorHasEventoSearch();
        $dataProvider = $searchModel->search($idevento);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'idevento' => $idevento,
        ]);
    }

    /**
     * Displays a single CoordenadorHasEvento model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CoordenadorHasEvento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(){
        $model = new CoordenadorHasEvento();
        $searchModel = new CoordenadorHasEventoSearch();
        
        $arrayUsuarios = ArrayHelper::map($searchModel->searchCoordenadores()->getModels(), 'idusuario', 'nome');
        $arrayEventosAtivos =  ArrayHelper::map((new EventoSearch())->searchEventosResponsavel('ativo')->getModels(), 'idevento', 'descricao');

        $idevento = filter_input(INPUT_GET, 'idevento');
        $model->evento_idevento = $idevento;

        if ($model->load(Yii::$app->request->post())) {
            try{
                $model->save();
                $this->mensagens('success', 'Coordenador Adicionado', 'O Coordenador '.$model->usuario->nome.' foi adicionado com Sucesso');
            }catch(IntegrityException $e){
                $this->mensagens('warning', 'Coordenador já Adicionado', 'O Coordenador '.$model->usuario->nome.' já adicionado ao evento');
            }catch(Exception $e){
                $this->mensagens('danger', 'Coordenador Não Adicionado', 'O Coordenador '.$model->usuario->nome.' não foi adicionado');
                
            }finally{
                return $this->redirect(['index', 'idevento' => $model->evento_idevento]); 
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'arrayUsuarios' => $arrayUsuarios,
                'arrayEventosAtivos' => $arrayEventosAtivos,
            ]);
        }
    }

    /**
     * Updates an existing CoordenadorHasEvento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->evento_idevento]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CoordenadorHasEvento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($usuario_idusuario, $evento_idevento)
    {
        $model = $this->findModel($usuario_idusuario, $evento_idevento);
        $coordenador = $model->usuario->nome;
        if($model->delete()){
            $this->mensagens('success', 'Coordenador Removido', 'O Coordenador '.$coordenador.' foi removido com Sucesso');
        }else{
            $this->mensagens('danger', 'Coordenador não removido', 'O Coordenador'.$coordenador.' não pode ser removido deste evento');
        }

        return $this->redirect(['index', 'idevento' => $evento_idevento]);
    }

    /**
     * Finds the CoordenadorHasEvento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CoordenadorHasEvento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($usuario_idusuario, $evento_idevento)
    {
        if (($model = CoordenadorHasEvento::findOne(['usuario_idusuario' => $usuario_idusuario, 'evento_idevento' => $evento_idevento])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

     /*Tipo: sucess, danger, warning*/
    protected function mensagens($tipo, $titulo, $mensagem){
        Yii::$app->session->setFlash($tipo, [
            'type' => $tipo,
            'duration' => 1500,
            'icon' => 'home',
            'message' => $mensagem,
            'title' => $titulo,
            'positonY' => 'bottom',
            'positonX' => 'right'
        ]);
    }
}
