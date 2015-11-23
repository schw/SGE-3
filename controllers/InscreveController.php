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

use yii\helpers\Html;

use kartik\mpdf\Pdf;
use mPDF;

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

        $searchModel = new Inscreve();
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

        $pacote  = new Inscreve(); 

        $quantidade_de_pacotes = $pacote->possuiPacote();

        if ($quantidade_de_pacotes != 0){


            $searchModel = new PacoteSearch();
            $dataProvider = $searchModel->searchEventoPacoteDisponivel($id_evento);
            $dataProvider2 = $searchModel->searchEventoPacoteIndisponivel($id_evento);

               return $this->render('pacote', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'dataProvider2' => $dataProvider2,
            ]);
        
        }
        
        if($inscreve->inscrever($id_evento) == 0 ){
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


        //$id_evento = Yii::$app->request->queryParams['id_evento']; 
        //$id_pacote = Yii::$app->request->queryParams['id_pacote']; 

         $id_evento = Yii::$app->request->post('id_evento'); 
-        $id_pacote = Yii::$app->request->post('id_pacote');

        $model = $this->findModel($id_evento);
        $inscreve = new Inscreve();

        //primeiro verifica se possui vagas o pacote !!!! é necessário em razão da concorrencia das requisicoes
        //caso não tenha vagas é redirecionado ao index
        if($inscreve->possuiVagasPacote($id_pacote) != 0){


                Yii::$app->getSession()->setFlash('danger', [
                     'type' => 'danger',
                     'message' => 'Inscrição no evento '.$model->sigla.' não foi efetuada, pois as vagas referente a esse pacote estão esgotadas',
                     'title' => 'Inscrição',
                     'positonY' => 'bottom',
                     'positonX' => 'right'
                 ]);

                return Yii::$app->getResponse()->redirect(array('/inscreve/', 'mensagem' =>'erro'));
            }
            //se retornar zero, é pq não foi possivel se inscrever, tendo em vista que o usuario já se encontra inscrito nesse evento
        else if($inscreve->inscreverComPacote($id_evento,$id_pacote) == 0){

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
            //caso ótimo: quando há vagas!
        $reduzir = new Inscreve();
        $reduzir->reduzirVagas($id_pacote,$id_evento,2); // redução das vagas no banco de dados !
                                                        //o valor 2 é pq há pacotes! 2 significa pacotes ; 1  significa sem pacotes

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
//inicio 

        $data_final_evento = Evento::findOne(['idevento' => $id_evento])->dataFim;
        $data_atual = date('Y/m/d');

        if(strtotime($data_atual) > strtotime($data_final_evento)) {
            
            Yii::$app->getSession()->setFlash('danger', [
                 'type' => 'danger',
                 'message' => 'O Evento '.$model->sigla.' já foi encerrado, não sendo possível cancelar a inscrição.',
                 'title' => 'Inscrição',
                 'positonY' => 'bottom',
                 'positonX' => 'right'
             ]);

            //Yii::$app->session->setFlash('message', 'Erro: Você não está inscrito nesse evento');   

            return Yii::$app->getResponse()->redirect(array('/inscreve/','mensagem' =>'erro'));
        }

        $cancela = new Inscreve();
        $resultado = $cancela->cancelar($id_evento);

        if ($resultado == 1){

        $pacote  = new Inscreve(); 

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


    public function converterMes($current){
        $mes_numero = (date('m',strtotime($current)));

        $mes = array ("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho",
        "Agosto","Setembro","Outubro","Novembro","Dezembro");


        return $mes[$mes_numero-1];
    }

//função necessária p/ gerar certificados, pois delimita o período inicial e final do evento
   public function tag($dia_inicio,$mes_inicio,$ano_inicio,$dia_fim,$mes_fim,$ano_fim){
        
        if($mes_inicio == $mes_fim && $ano_inicio == $ano_fim){

            $tag = '<b> '. $dia_inicio .' a '.$dia_fim .' de '.$mes_fim.'
                de '.$ano_fim.'</b>';
        }
        else if($mes_inicio != $mes_fim && $ano_inicio == $ano_fim){
            $tag = '<b> '. $dia_inicio .' de '.$mes_inicio.'
                a '.$dia_fim .' de '.$mes_fim.'
                de '.$ano_fim.'</b>';
        }

        else{

            $tag = '<b> '. $dia_inicio .' de '.$mes_inicio.'
                de '.$ano_inicio.' a '.$dia_fim .' de '.$mes_fim.'
                de '.$ano_fim.'</b>';

        }

            return $tag;
    }


    public function actionPdf() {
 
    // get your HTML raw content without any layouts or scripts
   
    // setup kartik\mpdf\Pdf component

        $id_evento = Yii::$app->request->post('evento_idevento'); 
        $model = $this->findModel($id_evento);
        

            $pdf = new mPDF('utf-8', 'A4-L');
            $pdf->WriteHTML(''); //se tirar isso, desaparece o cabeçalho

            if($model->imagem != NULL){

                $x=$pdf->WriteHTML("

                <style>
                    body {
                        
                        body{font-family:Arial;background-image: url(../web/uploads/".$model->imagem.") no-repeat;
                        background-image-resolution:300dpi;background-image-resize:6;}
                    }
                </style>



                    ");
            }   
            else{   

                $pdf->SetFont("Helvetica",'B', 14);
                $pdf->MultiCell(0,6,"PODER EXECUTIVO",0, 'C');
                $pdf->MultiCell(0,6,("MINISTÉRIO DA EDUCAÇÃO"),0, 'C');
                $pdf->MultiCell(0,6,("INSTITUTO DE COMPUTAÇÃO"),0, 'C');
                //$pdf->MultiCell(0,5,("-----------------"),0, 'C');
                $pdf->SetDrawColor(0,0,0);
                $pdf->Line(5,42,290,42);
                $pdf->Image('../web/img/logo-brasil.jpg', 10, 7, 32.32);
                $pdf->Image('../web/img/ufam.jpg', 260, 7, 25.25);
            }
 
            $pdf->Ln(45);
            $pdf->SetFont('Arial','B',22);

            if($model->imagem == NULL){
                $pdf->MultiCell(0,4,("Certificado"),0, 'C');
            }

        $nome= Yii::$app->user->identity->nome;

        $dia_inicio = (date('d',strtotime($model->dataIni)));
        $dia_inicio = ($dia_inicio == 1 ? '1º' : $dia_inicio); //convertendo o 1 em 1º
        $mes_inicio = $this->converterMes($model->dataIni);
        $ano_inicio = (date('Y',strtotime($model->dataIni)));

        $dia_fim = (date('d',strtotime($model->dataFim)));
        $dia_fim = ($dia_fim == 1 ? '1º' : $dia_fim); //convertendo o 1 em 1º
        $mes_fim = $this->converterMes($model->dataFim);
        $ano_fim = (date('Y',strtotime($model->dataFim)));

        $pdf->SetFont('Arial','',18);

        $pdf->Ln(20);

        $tag = $this->tag($dia_inicio,$mes_inicio,$ano_inicio,$dia_fim,$mes_fim,$ano_fim);

        $pdf->WriteHTML('<p style="font-size: 20px; text-align: justify;  text-indent: 80px;">
            Certificamos que <b>'. $nome.'</b> participou do evento <b>"'. $model->descricao.'" 
            ('.$model->sigla.')</b>, com carga horária de <b>'.$model->cargaHoraria.
                ' hora(s)</b>, realizado no período de '.$tag.', na cidade 
                de Manaus - AM.</p>');
    
        $pdf->Ln(15);
        
        $current = date('Y/m/d');

        $currentTime = strtotime($current);

        $mes = $this->converterMes($current);
        
        
        $pdf->Cell(0,5,('Manaus, '. date('d', $currentTime).' de '. $mes. ' de '. 
            date('Y', $currentTime).'.             '),0,1, 'C');
        if($model->imagem == NULL){
            $pdf->SetFont('Helvetica','I',8);
            $pdf->Line(5,185,290,185);
            $pdf->SetXY(10, 180);
            $pdf->MultiCell(0,5,"",0, 'C');
            $pdf->MultiCell(0,4,("Av. Rodrigo Otávio, 6.200 - Campus Universitário Senador Arthur Virgílio Filho - CEP 69077-000 - Manaus, AM, Brasil"),0, 'C');
            $pdf->MultiCell(0,4,(" Tel. (092) 3305-1193/2808/2809         E-mail: secretaria@icomp.ufam.edu.br          http://www.icomp.ufam.edu.br"),0, 'C');
            //$pdf->Image('components/com_portalsecretaria/images/icon_telefone.jpg', '40', '290');
            //$pdf->Image('components/com_portalsecretaria/images/icon_email.jpg', '73', '290');
            //$pdf->Image('components/com_portalsecretaria/images/icon_casa.jpg', '134', '290');

            // fim do aqui
        }
            $pdf->Output('');

            exit;

    }

}
