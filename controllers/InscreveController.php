<?php

namespace app\controllers;

use Yii;
use app\models\Inscreve;
use app\models\InscreveSearch;
// adicionado estes dois:
use app\models\EventoSearch;
use app\models\Evento;
// fim
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InscreveController implements the CRUD actions for Inscreve model.
 */
class InscreveController extends Controller
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
     * Lists all Inscreve models.
     * @return mixed
     */
    public function actionIndex()
    {
        /* isso era antes:
        $searchModel = new InscreveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
         fim do era antes ---- */


        $searchModel = new EventoSearch();
        $dataProvider = $searchModel->searchInscricao(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }

    /**
     * Displays a single Inscreve model.
     * @param integer $usuario_idusuario
     * @param integer $evento_idevento
     * @return mixed
     */
    
    public function actionView($id)
    {
    
        $model = $this->findModel($id);
        $model->dataIni = date("d-m-Y", strtotime($model->dataIni));
        $model->dataFim = date("d-m-Y", strtotime($model->dataFim));
        return $this->render('view', [
            'model' => $model,
        ]);

    }

        public function actionInscrever()
    {

        $searchModel = new EventoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $id_usuario = Yii::$app->request->post('usuario_idusuario');
        $id_evento = Yii::$app->request->post('evento_idevento'); 


        $sql = "INSERT INTO inscreve VALUES ('$id_usuario','$id_evento',1,NULL)";
        
        try{
            Yii::$app->db->createCommand($sql)->execute();
        }
        catch(\Exception $e){

            Yii::$app->session->setFlash('Falha', 'Você já está Inscrito neste evento');

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

        }

        Yii::$app->session->setFlash('Sucesso', 'Inscrição Efetuada com sucesso');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }


    public function actionCancelar()
    {

        $searchModel = new EventoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $id_usuario = Yii::$app->request->post('usuario_idusuario');
        $id_evento = Yii::$app->request->post('evento_idevento'); 


        $sql = "DELETE FROM inscreve WHERE usuario_idusuario = '$id_usuario' AND evento_idevento = '$id_evento'";
        

        $resultado = Yii::$app->db->createCommand($sql)->execute();

        if ($resultado == 1){
            Yii::$app->session->setFlash('Sucesso', 'Inscrição Cancelada com sucesso');
        }
        else{
            Yii::$app->session->setFlash('Falha', 'Erro: Você não está inscrito nesse evento');   
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }


        public function actionInscricoes()
    {

        $searchModel = new EventoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('inscricoes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }




    /**
     * Updates an existing Inscreve model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $usuario_idusuario
     * @param integer $evento_idevento
     * @return mixed
     */
    public function actionUpdate($usuario_idusuario, $evento_idevento)
    {
        $model = $this->findModel($usuario_idusuario, $evento_idevento);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'usuario_idusuario' => $model->usuario_idusuario, 'evento_idevento' => $model->evento_idevento]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Inscreve model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $usuario_idusuario
     * @param integer $evento_idevento
     * @return mixed
     */
    public function actionDelete($usuario_idusuario, $evento_idevento)
    {
        $this->findModel($usuario_idusuario, $evento_idevento)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Inscreve model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $usuario_idusuario
     * @param integer $evento_idevento
     * @return Inscreve the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Evento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
