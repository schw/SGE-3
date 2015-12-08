<?php

namespace app\controllers;
use app\models\User;
use app\models\Relatorios;
use app\models\Evento;
use Yii;
use mPDF;


class RelatoriosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
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


    public function actionCoordpdf() {
 
        $pdf = new mPDF('utf-8', 'A4-P');

        $x = $_POST['datainicial'];
        $y = $_POST['datafinal'];

        $pdf->WriteHTML(''); //se tirar isso, desaparece o cabeçalho

        $pdf->SetFont("Helvetica",'B', 14);
		
        $pdf->MultiCell(0,6,"PODER EXECUTIVO",0, 'C');
        $pdf->MultiCell(0,6,("MINISTÉRIO DA EDUCAÇÃO"),0, 'C');
        $pdf->MultiCell(0,6,("UNIVERSIDADE FEDERAL DO AMAZONAS"),0, 'C');
        $pdf->Ln(3);
        $pdf->MultiCell(0,6,("INSTITUTO DE COMPUTAÇÃO"),0, 'C');
        //$pdf->MultiCell(0,5,("-----------------"),0, 'C');
        $pdf->SetDrawColor(0,0,0);
        $pdf->Line(5,52,290,52);
        $pdf->Image('../web/img/logo-brasil.jpg', 10, 12, 32.32);
        $pdf->Image('../web/img/ufam.jpg', 175, 12, 25.25);

        //TÍLULO DO RELATÓRIO

        $pdf->Ln(15);
        $pdf->SetFont('Arial','',18);
        $pdf->MultiCell(0,6,("Coordenador de Evento x Nº de eventos coordenados"),0, 'C');
        //FIM DO TITULO DO RELATÓRIO

        $pdf->SetFont('Arial','',18);
        $pdf->Ln(10);

        $tag = $this->tag($dia_inicio,$mes_inicio,$ano_inicio,$dia_fim,$mes_fim,$ano_fim);

        //inicio da tabela
        $inicio = '<table border="1" align = "center">
                <tr>
                <th width = "550px">Coordenador de Evento</th>
                <th width = "100px">Quantidade de Eventos</th>
                </tr>
        ';

        $conteudo = "";
        $relatorio = new User();
        $model = $relatorio->getCoordenadoresEventos();//obtendo model dos coordenadores de eventos
        $qtd_rows = count($model); //quantidade de rows

        //meio da tabela -> aqui haverá as repetições de cada linha
        for ($i = 0; $i<$qtd_rows; $i++){

            $coordenador = $model[$i]->nome;
            $qtd_evento = $model[$i]->qtd_evento;

            $conteudo = $conteudo . '<tr>
                <td>'.$coordenador.'</td>
                <td align = "center">'.$qtd_evento.'</td>
                </tr>
            ';
        }
                
        //fim da tabela
        $pdf->WriteHTML($inicio.$conteudo.'</table>');
    
        $pdf->Ln(15);
        
        $current = date('Y/m/d');

        $currentTime = strtotime($current);

        $mes = $this->converterMes($current);
    
    	//DATA ATUAL   
        $pdf->MultiCell(0,4,('Relatório emitido por: '.Yii::$app->user->identity->nome),0, 'C');
        $pdf->Ln(3);
        $pdf->MultiCell(0,4,('Manaus, '.date('d', $currentTime).' de '. $mes. ' de '. 
            date('Y', $currentTime).'.'),0, 'C');
    	//FIM DA DATA ATUAL

            $pdf->SetFont('Helvetica','I',8);
            $pdf->Line(5,265,290,265);
            $pdf->SetXY(10, 265);
            $pdf->MultiCell(0,5,"",0, 'C');
            $pdf->MultiCell(0,4,("Av. Rodrigo Otávio, 6.200 - Campus Universitário Senador Arthur Virgílio Filho - CEP 69077-000 - Manaus, AM, Brasil"),0, 'C');
            $pdf->MultiCell(0,4,(" Tel. (092) 3305-1193/2808/2809         E-mail: secretaria@icomp.ufam.edu.br          http://www.icomp.ufam.edu.br"),0, 'C');

        $pdf->Output('');
        exit;

    }

    public function actionParticpdf() {
 
        $pdf = new mPDF('utf-8', 'A4-P');

        $pdf->WriteHTML(''); //se tirar isso, desaparece o cabeçalho

        $pdf->SetFont("Helvetica",'B', 14);
        
        $pdf->MultiCell(0,6,"PODER EXECUTIVO",0, 'C');
        $pdf->MultiCell(0,6,("MINISTÉRIO DA EDUCAÇÃO"),0, 'C');
        $pdf->MultiCell(0,6,("UNIVERSIDADE FEDERAL DO AMAZONAS"),0, 'C');
        $pdf->Ln(3);
        $pdf->MultiCell(0,6,("INSTITUTO DE COMPUTAÇÃO"),0, 'C');
        //$pdf->MultiCell(0,5,("-----------------"),0, 'C');
        $pdf->SetDrawColor(0,0,0);
        $pdf->Line(5,52,290,52);
        $pdf->Image('../web/img/logo-brasil.jpg', 10, 12, 32.32);
        $pdf->Image('../web/img/ufam.jpg', 175, 12, 25.25);

        //TÍLULO DO RELATÓRIO

        $pdf->Ln(15);
        $pdf->SetFont('Arial','',18);
        $pdf->MultiCell(0,6,("Participante x Quantidade de Inscrições"),0, 'C');
        //FIM DO TITULO DO RELATÓRIO

        $pdf->SetFont('Arial','',18);
        $pdf->Ln(10);

        $tag = $this->tag($dia_inicio,$mes_inicio,$ano_inicio,$dia_fim,$mes_fim,$ano_fim);

        //inicio da tabela
        $inicio = '<table border="1" align = "center">
                <tr>
                <th width = "550px">Participante</th>
                <th width = "100px">Quantidade de Inscrições</th>
                </tr>
        ';

        $conteudo = "";
        $relatorio = new User();
        $model = $relatorio->getParticipantesEventos();//obtendo model dos coordenadores de eventos
        $qtd_rows = count($model); //quantidade de rows

        //meio da tabela -> aqui haverá as repetições de cada linha
        for ($i = 0; $i<$qtd_rows; $i++){

            $coordenador = $model[$i]->nome;
            $qtd_evento = $model[$i]->qtd_evento;

            $conteudo = $conteudo . '<tr>
                <td>'.$coordenador.'</td>
                <td align = "center">'.$qtd_evento.'</td>
                </tr>
            ';
        }
                
        //fim da tabela
        $pdf->WriteHTML($inicio.$conteudo.'</table>');
    
        $pdf->Ln(15);
        
        $current = date('Y/m/d');

        $currentTime = strtotime($current);

        $mes = $this->converterMes($current);
    
        //DATA ATUAL   
        $pdf->MultiCell(0,4,('Relatório emitido por: '.Yii::$app->user->identity->nome),0, 'C');
        $pdf->Ln(3);
        $pdf->MultiCell(0,4,('Manaus, '.date('d', $currentTime).' de '. $mes. ' de '. 
            date('Y', $currentTime).'.'),0, 'C');
        //FIM DA DATA ATUAL

            $pdf->SetFont('Helvetica','I',8);
            $pdf->Line(5,265,290,265);
            $pdf->SetXY(10, 265);
            $pdf->MultiCell(0,5,"",0, 'C');
            $pdf->MultiCell(0,4,("Av. Rodrigo Otávio, 6.200 - Campus Universitário Senador Arthur Virgílio Filho - CEP 69077-000 - Manaus, AM, Brasil"),0, 'C');
            $pdf->MultiCell(0,4,(" Tel. (092) 3305-1193/2808/2809         E-mail: secretaria@icomp.ufam.edu.br          http://www.icomp.ufam.edu.br"),0, 'C');

        $pdf->Output('');
        exit;

    }

    public function actionEventopdf() {
 
        $pdf = new mPDF('utf-8', 'A4-P');

        $pdf->WriteHTML(''); //se tirar isso, desaparece o cabeçalho

        $pdf->SetFont("Helvetica",'B', 14);
        
        $pdf->MultiCell(0,6,"PODER EXECUTIVO",0, 'C');
        $pdf->MultiCell(0,6,("MINISTÉRIO DA EDUCAÇÃO"),0, 'C');
        $pdf->MultiCell(0,6,("UNIVERSIDADE FEDERAL DO AMAZONAS"),0, 'C');
        $pdf->Ln(3);
        $pdf->MultiCell(0,6,("INSTITUTO DE COMPUTAÇÃO"),0, 'C');
        //$pdf->MultiCell(0,5,("-----------------"),0, 'C');
        $pdf->SetDrawColor(0,0,0);
        $pdf->Line(5,52,290,52);
        $pdf->Image('../web/img/logo-brasil.jpg', 10, 12, 32.32);
        $pdf->Image('../web/img/ufam.jpg', 175, 12, 25.25);

        //TÍLULO DO RELATÓRIO

        $pdf->Ln(15);
        $pdf->SetFont('Arial','',18);
        $pdf->MultiCell(0,6,("Evento x Total de Inscrito"),0, 'C');
        //FIM DO TITULO DO RELATÓRIO

        $pdf->SetFont('Arial','',18);
        $pdf->Ln(10);

        $tag = $this->tag($dia_inicio,$mes_inicio,$ano_inicio,$dia_fim,$mes_fim,$ano_fim);

        //inicio da tabela
        $inicio = '<table border="1" align = "center">
                <tr>
                <th width = "550px">Sigla do Evento</th>
                <th width = "100px">Total de Inscritos</th>
                </tr>
        ';

        $conteudo = "";
        $relatorio = new Evento();
        $model = $relatorio->getInscritosEventos();//obtendo model dos coordenadores de eventos
        $qtd_rows = count($model); //quantidade de rows

        //meio da tabela -> aqui haverá as repetições de cada linha
        for ($i = 0; $i<$qtd_rows; $i++){

            $coordenador = $model[$i]->sigla;
            $qtd_evento = $model[$i]->qtd_evento;

            $conteudo = $conteudo . '<tr>
                <td>'.$coordenador.'</td>
                <td align = "center">'.$qtd_evento.'</td>
                </tr>
            ';
        }
                
        //fim da tabela
        $pdf->WriteHTML($inicio.$conteudo.'</table>');
    
        $pdf->Ln(15);
        
        $current = date('Y/m/d');

        $currentTime = strtotime($current);

        $mes = $this->converterMes($current);
    
        //DATA ATUAL   
        $pdf->MultiCell(0,4,('Relatório emitido por: '.Yii::$app->user->identity->nome),0, 'C');
        $pdf->Ln(3);
        $pdf->MultiCell(0,4,('Manaus, '.date('d', $currentTime).' de '. $mes. ' de '. 
            date('Y', $currentTime).'.'),0, 'C');
        //FIM DA DATA ATUAL

            $pdf->SetFont('Helvetica','I',8);
            $pdf->Line(5,265,290,265);
            $pdf->SetXY(10, 265);
            $pdf->MultiCell(0,5,"",0, 'C');
            $pdf->MultiCell(0,4,("Av. Rodrigo Otávio, 6.200 - Campus Universitário Senador Arthur Virgílio Filho - CEP 69077-000 - Manaus, AM, Brasil"),0, 'C');
            $pdf->MultiCell(0,4,(" Tel. (092) 3305-1193/2808/2809         E-mail: secretaria@icomp.ufam.edu.br          http://www.icomp.ufam.edu.br"),0, 'C');

        $pdf->Output('');
        exit;

    }

}
