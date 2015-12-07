<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\ItemProgramacao;
use app\models\Local;
use app\models\Tipo;
use app\models\Palestrante;
use app\models\ItemProgramacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemProgramacaoController implements the CRUD actions for ItemProgramacao model.
 */
class ItemProgramacaoController extends Controller
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
     * Lists all ItemProgramacao models.
     * @return mixed
     */
    public function actionIndex($idevento)
    {

        $itemProgramacaoSearch = new ItemProgramacaoSearch();
        $itensProgramacaoBanco = $itemProgramacaoSearch->search(['idevento' => $idevento])->getModels();
        $itensProgramacaoCalendar = array();

        foreach($itensProgramacaoBanco as $itemProgramacao){
            $itemProgramacaoCalendar = new \yii2fullcalendar\models\Event();
            $itemProgramacaoCalendar->id = $itemProgramacao->iditemProgramacao;
            $itemProgramacaoCalendar->title = $itemProgramacao->titulo;
            $itemProgramacaoCalendar->start = $itemProgramacao->data."T".$itemProgramacao->hora;
            $itemProgramacaoCalendar->id = $itemProgramacao->iditemProgramacao;
            $itensProgramacaoCalendar[] = $itemProgramacaoCalendar;
        }

        $arrayTipo = ArrayHelper::map(Tipo::find()->all(), 'idtipo', 'titulo');
        $arrayLocal = ArrayHelper::map(Local::find()->all(), 'idlocal', 'descricao');

        return $this->render('index', [
            'itensProgramacaoCalendar' => $itensProgramacaoCalendar,
            'arrayTipo' => $arrayTipo,
            'arrayLocal' => $arrayLocal,
        ]);
    }

    /**
     * Displays a single ItemProgramacao model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->data = date("d-m-Y", strtotime($model->data));

        return $this->renderAjax('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new ItemProgramacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItemProgramacao();
        $model->notificacao = '1';

        $model->data = filter_input(INPUT_GET, 'data');
        $model->hora = filter_input(INPUT_GET, 'hora');
        $model->tipo_idtipo = filter_input(INPUT_GET, 'tipo');
        
        $arrayPalestrante = ArrayHelper::map(Palestrante::find()->all(), 'idPalestrante', 'nome');
        $arrayLocal = ArrayHelper::map(Local::find()->all(), 'idlocal', 'descricao');
        $arrayTipo = ArrayHelper::map(Tipo::find()->all(), 'idtipo', 'titulo');
        
        $model->evento_idevento = Yii::$app->request->get('idevento');
        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){                
                return $this->redirect(['index', 'idevento' => $model->evento_idevento]);
            }else{
                print_r($model->getErrors());
            }
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'arrayTipo' => $arrayTipo,
                'arrayLocal' => $arrayLocal,
                'arrayPalestrante' => $arrayPalestrante,
            ]);
        }
    }

    /**
     * Updates an existing ItemProgramacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $arrayPalestrante = ArrayHelper::map(Palestrante::find()->all(), 'idPalestrante', 'nome');
        $arrayLocal = ArrayHelper::map(Local::find()->all(), 'idlocal', 'descricao');
        $arrayTipo = ArrayHelper::map(Tipo::find()->all(), 'idtipo', 'titulo');
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->iditemProgramacao]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'arrayTipo' => $arrayTipo,
                'arrayLocal' => $arrayLocal,
                'arrayPalestrante' => $arrayPalestrante,
            ]);
        }
    }

    /**
     * Deletes an existing ItemProgramacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $idevento = $model->evento_idevento;
        $model->delete();

        return $this->redirect(['index', 'idevento' => $idevento]);
    }

    /**
     * Finds the ItemProgramacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemProgramacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItemProgramacao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
