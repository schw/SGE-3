<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inscreve;
use app\models\Evento;
use app\models\Tipo;

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
        //Listando apenas Eventos de um determinado professor
        //$query = Inscreve::find()->where(['usuario_idusuario' => Yii::$app->user->identity->idusuario]);
        
        if (!Yii::$app->user->isGuest) {
            $query =    Inscreve::find()->where(['usuario_idusuario' => Yii::$app->user->identity->idusuario]);
        }
        else {
            return Yii::$app->getResponse()->redirect(array('/evento/', NULL )); // é redirecionado a tela de eventos, se não estiver logado
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
/*
        $dataProvider->sort->attributes['tipo'] = [
        'asc' => ['titulo' => SORT_ASC],
        'desc' => ['titulo' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['local'] = [
        'asc' => ['descricao' => SORT_ASC],
        'desc' => ['descricao' => SORT_DESC],
        ];

        $query->andFilterWhere([
            'idevento' => $this->idevento,
            'horaIni' => $this->horaIni,
            'horaFim' => $this->horaFim,
            'vagas' => $this->vagas,
            'cargaHoraria' => $this->cargaHoraria,
            'allow' => $this->allow,
            'responsavel' => $this->responsavel,
        ]);

        $query->andFilterWhere(['like', 'sigla', $this->sigla])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'dataIni', $this->dataIni])
            ->andFilterWhere(['like', 'dataFim', $this->dataFim])
            ->andFilterWhere(['like', 'imagem', $this->imagem])
            ->andFilterWhere(['like', 'detalhe', $this->detalhe])
            ->andFilterWhere(['like', 'tipo.titulo', $this->tipo])
            ->andFilterWhere(['like', 'local.descricao', $this->descricao]);

*/
        return $dataProvider;
    }

}
