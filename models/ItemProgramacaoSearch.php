<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItemProgramacao;

/**
 * ItemProgramacaoSearch represents the model behind the search form about `app\models\ItemProgramacao`.
 */
class ItemProgramacaoSearch extends ItemProgramacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iditemProgramacao', 'vagas', 'cargaHoraria', 'local_idlocal', 'evento_idevento', 'tipo_idtipo'], 'integer'],
            [['titulo', 'descricao', 'data', 'hora', 'horaFim', 'detalhe', 'notificacao'], 'safe'],
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
        $query = ItemProgramacao::find()->where(['evento_idevento' => $params['idevento']]);

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
            'iditemProgramacao' => $this->iditemProgramacao,
            'hora' => $this->hora,
            'vagas' => $this->vagas,
            'cargaHoraria' => $this->cargaHoraria,
            'local_idlocal' => $this->local_idlocal,
            'evento_idevento' => $this->evento_idevento,
            'tipo_idtipo' => $this->tipo_idtipo,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'detalhe', $this->detalhe])
            ->andFilterWhere(['like', 'notificacao', $this->notificacao]);

        return $dataProvider;
    }
}
