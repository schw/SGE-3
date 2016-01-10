<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inscreve;
use app\models\Evento;
use app\models\Tipo;
use app\models\User;
use app\models\ItemProgramacao;
use app\models\Palestrante;
/**
 * InscreveSearch represents the model behind the search form about `app\models\Inscreve`.
 */
class InscreveSearch extends Inscreve
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_idusuario', 'evento_idevento', 'pacote_idpacote'], 'integer'],
            [['credenciado'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Inscreve::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'usuario_idusuario' => $this->usuario_idusuario,
            'evento_idevento' => $this->evento_idevento,
            'pacote_idpacote' => $this->pacote_idpacote,
        ]);

        $query->andFilterWhere(['like', 'credenciado', $this->credenciado]);

        return $dataProvider;
    }

public function searchInscricoes($params)
    {

        
        if (!Yii::$app->user->isGuest) {
            $query = Inscreve::find()->where(['usuario_idusuario' => Yii::$app->user->identity->idusuario])
            ->andWhere("dataFim > '". date('Y-m-d')."'")
            ->innerJoin('evento','evento.idevento = inscreve.evento_idevento')
            ->innerJoin('tipo','evento.tipo_idtipo = tipo.idtipo');
        }
        else {
            return Yii::$app->getResponse()->redirect(array('/evento/', NULL )); // é redirecionado a tela de eventos, se não estiver logado
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['evento.sigla','evento.descricao','credenciado','evento.pacote.descricao','tipo.titulo']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }

public function searchInscricoespassadas($params)
    {

        
        if (!Yii::$app->user->isGuest) {
            $query = Inscreve::find()->where(['usuario_idusuario' => Yii::$app->user->identity->idusuario])
            ->andWhere("dataFim < '". date('Y-m-d')."'")
            ->innerJoin('evento','evento.idevento = inscreve.evento_idevento')
            ->innerJoin('tipo','evento.tipo_idtipo = tipo.idtipo');
        }
        else {
            return Yii::$app->getResponse()->redirect(array('/evento/', NULL )); // é redirecionado a tela de eventos, se não estiver logado
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['evento.sigla','evento.descricao','credenciado','tipo.titulo']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }

//não mexer, pois é referente ao Gerenciar Credenciamento
public function searchInscritos($params)
    {

        
        if (!Yii::$app->user->isGuest) {
            $query = Inscreve::find()->where(['inscreve.evento_idevento' => $params['evento_idevento']])
            ->leftJoin('pacote','pacote.idpacote = inscreve.pacote_idpacote')
            ->innerJoin('user','user.idusuario = inscreve.usuario_idusuario ');
        }
        else {
            return Yii::$app->getResponse()->redirect(array('/evento/', NULL )); // é redirecionado a tela de eventos, se não estiver logado
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->sort->attributes['Participante'] = [
        'asc' => ['user.nome' => SORT_ASC],
        'desc' => ['user.nome' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
       return $dataProvider;
    }


//usado para gerar lista de crendenciados com a finalidade de imprimir certificados!!!
    public function searchCredenciados()
    {
            
        $id_evento = Yii::$app->request->post('evento_idevento');
        
        if (!Yii::$app->user->isGuest) {
            $query = Inscreve::find()->where(['evento_idevento' => $id_evento])->andWhere(['credenciado' => 1])
            ->innerJoin('user','user.idusuario = inscreve.usuario_idusuario')
            ->orderBy('user.nome');
        }
        else {
            return Yii::$app->getResponse()->redirect(array('/evento/', NULL )); // é redirecionado a tela de eventos, se não estiver logado
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
       return $dataProvider;
    }

    public function searchPalestrantes()
    {
            
        $id_evento = Yii::$app->request->post('evento_idevento');
        
        if (!Yii::$app->user->isGuest) {

            $query = Palestrante::find()->where(['evento_idevento' => $id_evento])
            ->joinWith('itemProgramacao');
            
            $query2 = Palestrante::find()->where(['idevento' => $id_evento])
            ->joinWith('evento');
            $query->union($query2);
            $query->orderBy('palestrante.nome');

        }
        else {
            return Yii::$app->getResponse()->redirect(array('/evento/', NULL )); // é redirecionado a tela de eventos, se não estiver logado
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
       return $dataProvider;
    }

    public function searchVoluntarios()
    {
            
        $id_evento = Yii::$app->request->post('evento_idevento');
        
        if (!Yii::$app->user->isGuest) {
            //$query = ItemProgramacao::find()->where(['evento_idevento' => $id_evento]);
            $query = EventoHasVoluntario::find()->where(['evento_idevento' => $id_evento])
            ->innerJoin('voluntario','voluntario.idvoluntario = evento_has_voluntario.voluntario_idvoluntario')
            ->orderBy('voluntario.nome');
        }
        else {
            return Yii::$app->getResponse()->redirect(array('/evento/', NULL )); // é redirecionado a tela de eventos, se não estiver logado
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
       return $dataProvider;
    }

}
