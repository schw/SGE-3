<?php

namespace app\controllers;

use Yii;
use app\models\Inscreve;
use app\models\InscreveSearch;
// adicionado estes seis:
use app\models\EventoSearch;
use app\models\Evento;
use app\models\ItemProgramacao;
use app\models\ItemProgramacaoSearch;
use app\models\Pacote;
use app\models\PacoteSearch;
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

    public function actionVerificaInscrito()
    {

        $searchModel = new InscreveSearch();
        $dataProvider = $searchModel->VerificaInscrito(Yii::$app->request->queryParams);

        return $dataProvider;

    }


        public function actionInscrever()
    {

        $searchModel = new InscreveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $id_evento = Yii::$app->request->post('evento_idevento'); 

        $model = $this->findModel($id_evento);

        $inscreve = new Inscreve();

        $pacote  = new Pacote(); 

        $quantidade_de_pacotes = $pacote->possuiPacote();

        if ($quantidade_de_pacotes != 0){


            $searchModel = new PacoteSearch();
            $dataProvider = $searchModel->searchEventoPacote($id_evento);

               return $this->render('pacote', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        
        }
        
        if($inscreve->inscrever($id_evento) == FALSE ){
            Yii::$app->getSession()->setFlash('danger', [
                 'type' => 'danger',
                 'message' => 'Inscrição no evento '.$model->sigla.' não foi efetuada, pois você já está inscrito nesse evento',
                 'title' => 'Inscrição',
                 'positonY' => 'bottom',
                 'positonX' => 'right'
             ]);

        return Yii::$app->getResponse()->redirect(array('/inscreve/', 'mensagem' =>'erro'));
        }
        else{

        $reduzir = new Inscreve();
        $reduzir->reduzirVagas(NULL,$id_evento,1);

            Yii::$app->getSession()->setFlash('success', [
                 'type' => 'success',
                 'message' => 'Inscrição no evento '.$model->sigla.' Efetuada com Sucesso',
                 'title' => 'Inscrição',
                 'positonY' => 'bottom',
                 'positonX' => 'right'
             ]);
            return Yii::$app->getResponse()->redirect(array('/inscreve/','mensagem' =>'sucesso'));
        }       

    }


        public function actionAddpacote()
    {

        $searchModel = new InscreveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $id_evento = Yii::$app->request->post('id_evento'); 
        $id_pacote = Yii::$app->request->post('id_pacote'); 

        $model = $this->findModel($id_evento);
        $inscreve = new Inscreve();

        if($inscreve->inscreverComPacote($id_evento,$id_pacote) == FALSE ){
            Yii::$app->getSession()->setFlash('danger', [
                 'type' => 'danger',
                 'message' => 'Inscrição no evento '.$model->sigla.' não foi efetuada, pois você já está inscrito nesse evento',
                 'title' => 'Inscrição',
                 'positonY' => 'bottom',
                 'positonX' => 'right'
             ]);

        return Yii::$app->getResponse()->redirect(array('/inscreve/', 'mensagem' =>'erro'));
        }
        else{

        $reduzir = new Inscreve();
        $reduzir->reduzirVagas($id_pacote,$id_evento,2);

            Yii::$app->getSession()->setFlash('success', [
                 'type' => 'success',
                 'message' => 'Inscrição no evento '.$model->sigla.' Efetuada com Sucesso',
                 'title' => 'Inscrição',
                 'positonY' => 'bottom',
                 'positonX' => 'right'
             ]);
            return Yii::$app->getResponse()->redirect(array('/inscreve/','mensagem' =>'sucesso'));
        }       

    }



    public function actionCancelar()
    {

        $searchModel = new InscreveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $id_usuario = Yii::$app->user->identity->idusuario;
        $id_evento = Yii::$app->request->post('evento_idevento'); 
        $id_pacote = Inscreve::findOne(['usuario_idusuario' => $id_usuario,'evento_idevento' => $id_evento])->pacote_idpacote;

        $model = $this->findModel($id_evento);


        $sql = "DELETE FROM inscreve WHERE usuario_idusuario = '$id_usuario' AND evento_idevento = '$id_evento'";
        
        $resultado = Yii::$app->db->createCommand($sql)->execute();

        if ($resultado == 1){
            

        $pacote  = new Pacote(); 

        $quantidade_de_pacotes = $pacote->possuiPacote();

        if ($quantidade_de_pacotes != 0){

            $aumentar = new Inscreve();
            $aumentar->aumentarVagas($id_pacote,$id_evento,2);

        }
        else{

            $aumentar = new Inscreve();
            $aumentar->aumentarVagas(NULL,$id_evento,1);            

        }
                Yii::$app->getSession()->setFlash('success', [
                 'type' => 'success',
                 'message' => 'Inscrição no evento '.$model->sigla.' foi cancelada com sucesso',
                 'title' => 'Inscrição',
                 'positonY' => 'bottom',
                 'positonX' => 'right'
            ]);


            return Yii::$app->getResponse()->redirect(array('/inscreve/','mensagem' =>'sucesso'));

        }
        else{

            Yii::$app->getSession()->setFlash('danger', [
                 'type' => 'danger',
                 'message' => 'Você não está inscrito no evento '.$model->sigla.'.',
                 'title' => 'Inscrição',
                 'positonY' => 'bottom',
                 'positonX' => 'right'
             ]);

            //Yii::$app->session->setFlash('message', 'Erro: Você não está inscrito nesse evento');   

            return Yii::$app->getResponse()->redirect(array('/inscreve/','mensagem' =>'erro'));
        }
       


    }


        public function actionIndex()
    {

        $searchModel = new InscreveSearch();
        $dataProvider = $searchModel->searchInscricoes(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }



        public function actionProgramacao()
    {

        $searchModel = new ItemProgramacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('programacao', [
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
