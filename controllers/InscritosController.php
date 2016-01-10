<?php

namespace app\controllers;

use Yii;
use app\models\Inscreve;
use app\models\InscreveSearch;
use app\models\User;
// adicionado estes quatro:
use app\models\EventoSearch;
use app\models\Evento;
use app\models\ItemProgramacao;
use app\models\ItemProgramacaoSearch;
// fim
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

use mPDF;

/**
 * InscreveController implements the CRUD actions for Inscreve model.
 */
class InscritosController extends Controller
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


    public function actionIndex()
    {
        $idevento = Yii::$app->request->get('evento_idevento');

        if(!$idevento)
            $this->redirect(['evento/index']);

        $evento = Evento::findOne($idevento);

        $searchModel = new InscreveSearch();
        $dataProvider = $searchModel->searchInscritos(Yii::$app->request->queryParams);

        //$query = InscreveSearch::find();

        //$pagination = new Pagination([
        //    'defaultPageSize' => 5,
        //    'totalCount' => $query->count(),
        //]);

        //$credenciado = $query->select('usuario_idusuario, credenciado')
        //    ->from('inscreve')
        //    ->where(['evento_idevento' => '$idevento'] AND ['credenciado' => '1'])
        //    ->offset($pagination->offset)
        //    ->limit($pagination->limit)
        //    ->all();

        //$credenciado = $query->select([
        //    'user.nome AS Nome',
        //    'inscreve.credenciado AS Credenciado']) 
        //->from('user')
        //->join('INNER JOIN',
        //        'inscreve',
        //        'inscreve.usuario_idusuario = user.idusuario'
        //);

        //$command = $query->createCommand();
        //$data = $command->queryAll();  

        return $this->render('index', [
            //'credenciado' => $credenciado,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'evento' => $evento,
            //'pagination' => $pagination,
        ]);
    }

    public function actionCredenciar()
    {

        $id_usuario = Yii::$app->request->post('idusuario');
        $id_evento = Yii::$app->request->post('evento_idevento');


        $sql = "UPDATE inscreve SET credenciado = '1' WHERE usuario_idusuario = '$id_usuario' AND evento_idevento = '$id_evento'";
        
        try{
            echo Yii::$app->db->createCommand($sql)->execute();
        }
        catch(\Exception $e){

            Yii::$app->getSession()->setFlash('danger', [
                 'type' => 'danger',
                 'message' => 'O participante já está credenciado neste evento',
                 'title' => 'Credenciamento',
                 'positonY' => 'bottom',
                 'positonX' => 'right'
             ]);

            return Yii::$app->getResponse()->redirect(array('/inscritos/index','evento_idevento' => $id_evento, 'mensagem' =>'erro'));
        }

            Yii::$app->getSession()->setFlash('success', [
                 'type' => 'success',
                 'message' => 'Credenciamento realizado com sucesso',
                 'title' => 'Credenciamento',
                 'positonY' => 'bottom',
                 'positonX' => 'right'
             ]);
            return Yii::$app->getResponse()->redirect(array('/inscritos/index','evento_idevento' => $id_evento, 'mensagem' =>'sucesso'));
    }

    public function actionDescredenciar()
    {

        $id_usuario = Yii::$app->request->post('idusuario');
        $id_evento = Yii::$app->request->post('evento_idevento');


        $sql = "UPDATE inscreve SET credenciado = '0' WHERE usuario_idusuario = '$id_usuario' AND evento_idevento = '$id_evento'";
        
        try{
            echo Yii::$app->db->createCommand($sql)->execute();
        }
        catch(\Exception $e){

             Yii::$app->getSession()->setFlash('danger', [
                 'type' => 'danger',
                 'message' => 'O participante já está credenciado neste evento',
                 'title' => 'Descredenciamento',
                 'positonY' => 'bottom',
                 'positonX' => 'right'
             ]);

            return Yii::$app->getResponse()->redirect(array('/inscritos/index','evento_idevento' => $id_evento, 'mensagem' =>'erro'));
        }

            Yii::$app->getSession()->setFlash('success', [
                 'type' => 'success',
                 'message' => 'Descredenciamento realizado com sucesso',
                 'title' => 'Descredenciamento',
                 'positonY' => 'bottom',
                 'positonX' => 'right'
             ]);
            return Yii::$app->getResponse()->redirect(array('/inscritos/index','evento_idevento' => $id_evento, 'mensagem' =>'sucesso'));
    }

    public function actionCancelar()
    {

        $searchModel = new InscreveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $id_usuario = Yii::$app->request->post('idusuario'); 
        $id_evento = Yii::$app->request->post('evento_idevento'); 
       
        $model = $this->findModel($id_evento);

        $id_pacote = Inscreve::findOne(['usuario_idusuario' => $id_usuario,'evento_idevento' => $id_evento])->pacote_idpacote;

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

            return Yii::$app->getResponse()->redirect(array('/inscritos/', 'evento_idevento' => $id_evento));
        }

        $cancela = new Inscreve();
        $resultado = $cancela->cancelarCoord($id_evento,$id_usuario);

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
                     'message' => 'Inscrição cancelada com sucesso.',
                     'title' => 'Inscrição',
                     'positonY' => 'bottom',
                     'positonX' => 'right'
                ]);


                return Yii::$app->getResponse()->redirect(array('/inscritos/', 'evento_idevento' => $id_evento));

        }
        else{

            Yii::$app->getSession()->setFlash('danger', [
                 'type' => 'danger',
                 'message' => 'Não foi possível cancelar a inscrição, pois esse perticipante não está inscrito no evento. ',
                 'title' => 'Inscrição',
                 'positonY' => 'bottom',
                 'positonX' => 'right'
             ]);

            //Yii::$app->session->setFlash('message', 'Erro: Você não está inscrito nesse evento');   

            return Yii::$app->getResponse()->redirect(array('/inscritos/', 'evento_idevento' => $id_evento));
        }

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

//funcao que converte mes em numeral para extenso
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

    public function pdfConteudo($pdf,$model,$ItemProgramacao,$j){

            $pdf->WriteHTML(''); //se tirar isso, desaparece o cabeçalho

            $pdf->SetFont("Helvetica",'B', 14);

            //$pdf->MultiCell(0,6,"PODER EXECUTIVO",0, 'C');
            //$pdf->MultiCell(0,6,("MINISTÉRIO DA EDUCAÇÃO"),0, 'C');
            //$pdf->MultiCell(0,6,("UNIVERSIDADE FEDERAL DO AMAZONAS"),0, 'C');
            $pdf->Ln(15);
            //$pdf->MultiCell(0,6,("INSTITUTO DE COMPUTAÇÃO"),0, 'C');
            //$pdf->MultiCell(0,5,("-----------------"),0, 'C');
            $pdf->SetDrawColor(0,0,0);
            $pdf->Line(5,42,290,42);
            //$pdf->Image('../web/img/logo-brasil.jpg', 10, 12, 32.32);
            //$pdf->Image('../web/img/ufam.jpg', 175, 12, 25.25);

            //TÍLULO DO RELATÓRIO

            $pdf->Ln(15);
            $pdf->SetFont('Arial','',18);
            $pdf->MultiCell(0,6,("Lista de Participantes"),0, 'C');
            //FIM DO TITULO DO RELATÓRIO

            $pdf->Ln(5);
            $pdf->SetFont('Arial','',12);
            //$pdf->Line(5,55,290,55);
            if ($j != -1){ //so entra nesse if, se houver itens de programação

                $pdf->WriteHTML('<table width="100%" border = "1"> 
                    <tr>
                        <td>Sigla: '.$ItemProgramacao[$j]->sigla.'
                        <br>
                        Evento: '.$ItemProgramacao[$j]->descricao.'
                        <br>
                        Programação: '.$ItemProgramacao[$j]->titulo.'
                        </td>
                    </tr>
                    </table>
                    ');

                //$pdf->MultiCell(0,6,('Sigla: '.$ItemProgramacao[$j]->sigla),0, 'L');   
                //$pdf->MultiCell(0,6,('Evento: '.$ItemProgramacao[$j]->descricao.'('.$ItemProgramacao[$j]->sigla.')'),0, 'L');   
                //$pdf->MultiCell(0,6,('Programação: '.$ItemProgramacao[$j]->titulo),0, 'L');
            }
            else{
                    if($model[0]->descricao != NULL){

                        $pdf->WriteHTML('<table width="100%" border = "1"> 
                            <tr>
                                <td>
                                Evento: '.$model[0]->descricao.'
                                </td>
                            </tr>
                            </table>
                        ');

                        //$pdf->MultiCell(0,6,('Evento: '.$model[0]->descricao),0, 'L');   
                    }
                    else{
                        $evento_idevento = Yii::$app->request->get('evento_idevento'); 
                        $dadosEvento = Evento::findOne($evento_idevento);
                        
                        $pdf->WriteHTML('<table width="100%" border = "1"> 
                            <tr>
                                <td>
                                Evento: '.$dadosEvento->descricao.'
                                </td>
                            </tr>
                            </table>
                        ');
                    }
            }
            //$pdf->Line(5,77,290,77);

            $pdf->Ln(5);

            $tag = $this->tag($dia_inicio,$mes_inicio,$ano_inicio,$dia_fim,$mes_fim,$ano_fim);

                //inicio da tabela
                $inicio = '
                    <table border="1" align = "center">
                        <tr>
                        <th> # </th>
                        <th width = "250px">Nome do Participante</th>
                        <th width = "500px">Assinatura</th>
                        </tr>
                ';

            $conteudo = "";
            $qtd_rows = count($model); //quantidade de rows
            if ($qtd_rows != 0){

                //meio da tabela -> aqui haverá as repetições de cada linha
                for ($i = 0; $i<$qtd_rows; $i++){

                    $participante = $model[$i]->nome;


                    $conteudo = $conteudo . '<tr>
                        <td width = "30px">'.($i+1).'</td>
                        <td>'.$participante.'</td>
                        <td height = "40px" align = "center"></td>
                        </tr>
                    ';
                }
                        
                //fim da tabela
                $pdf->WriteHTML($inicio.$conteudo.'</table>');
            }
            else {
                $pdf->SetFont('Arial','',22);
                $pdf->WriteHTML('<br>'.'<div align = "center"> Não foram encontrados registros de Participantes. </div>');   
            }
            $pdf->Ln(15);
            
            $current = date('Y/m/d');

            $currentTime = strtotime($current);

            $mes = $this->converterMes($current);
        
            //DATA ATUAL   
            $pdf->MultiCell(0,4,('Manaus, '.date('d', $currentTime).' de '. $mes. ' de '. 
                date('Y', $currentTime).'.'),0, 'C');
            //FIM DA DATA ATUAL

                //$pdf->SetFont('Helvetica','I',8);
                $pdf->Line(5,275,290,275);
                //$pdf->SetXY(10, 265);
                //$pdf->MultiCell(0,5,"",0, 'C');
                //$pdf->MultiCell(0,4,("Av. Rodrigo Otávio, 6.200 - Campus Universitário Senador Arthur Virgílio Filho - CEP 69077-000 - Manaus, AM, Brasil"),0, 'C');
                //$pdf->MultiCell(0,4,(" Tel. (092) 3305-1193/2808/2809         E-mail: secretaria@icomp.ufam.edu.br          http://www.icomp.ufam.edu.br"),0, 'C');

        return $pdf;

    }


    public function actionListainscritospdf() {

        $id_evento = Yii::$app->request->get('evento_idevento');       

        $ItemProgramacao = new ItemProgramacao();
        $ItemProgramacao = $ItemProgramacao->getListaItem($id_evento);

        $qtd_item_programacao = count($ItemProgramacao);

        $model = new User(); 
        $model = $model->getListaInscritos($id_evento);

        $pdf = new mPDF('utf-8', 'A4-P');

            $pdf->SetHTMLHeader('
                <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
                    <tr>
                        <td width="20%" align="center" style="font-family: Arial;font-weight: bold; font-size: 175%;"> <img src = "../web/img/logo-brasil.jpg" height="90px" width="90px"> </td>
                        <td width="60%" align="center" style="font-family: Arial;font-weight: bold; font-size: 175%;">  PODER EXECUTIVO <br> UNIVERSIDADE FEDERAL DO AMAZONAS <br> INSTITUTO DE COMPUTAÇÃO </td>
                        <td width="20%" align="center" style="font-family: Arial;font-weight: bold; font-size: 175%;"> <img src = "../web/img/ufam.jpg" height="90px" width="70px"> </td>                    </tr>
                </table>
            ');

            $pdf->SetHTMLFooter('
                <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
                    <tr>
                        <td  colspan = "3" align="center" ><span style="font-weight: bold"> Av. Rodrigo Otávio, 6.200 - Campus Universitário Senador Arthur Virgílio Filho - CEP 69077-000 - Manaus, AM, Brasil </span></td>
                    </tr>
                    <tr>
                        <td width="33%" align="center" style="font-weight: bold; font-style: italic;">  Tel. (092) 3305-1193/2808/2809</td>
                        <td width="33%" align="center" style="font-weight: bold; font-style: italic;">  E-mail: secretaria@icomp.ufam.edu.br</td>
                        <td width="33%" align="center" style="font-weight: bold; font-style: italic;">  http://www.icomp.ufam.edu.br </td>
                    </tr>
                </table>
            ');


        if($qtd_item_programacao == 0){ //não há itens de programação, ou seja, so o evento

            $pdf = $this->pdfConteudo($pdf,$model,0,-1);

        }
        else{

            for($j = 0 ; $j < $qtd_item_programacao; $j++){

            $model2 = new Evento(); 
            $model2 = $model2->getInscritosEventosPacotes($ItemProgramacao[$j]->iditemProgramacao);

                if(count($model2) == 0){

                    $pdf = $this->pdfConteudo($pdf,$model,$ItemProgramacao,$j);
                }
                else{
                    $pdf = $this->pdfConteudo($pdf,$model2,$ItemProgramacao,$j);
                }
                if($j < $qtd_item_programacao-1){
                    $pdf->AddPage();
                }
            }
        }
        $pdf->Output('');
        exit;

    }


}
