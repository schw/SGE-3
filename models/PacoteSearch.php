<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pacote;

/**
 * PacoteSearch represents the model behind the search form about `app\models\Pacote`.
 */
class PacoteSearch extends Pacote
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idpacote', 'perfil_idperfil', 'evento_idevento'], 'integer'],
            [['titulo', 'descricao', 'status'], 'safe'],
            [['valor'], 'number'],
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
        $query = Pacote::find();

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
            'idpacote' => $this->idpacote,
            'valor' => $this->valor,
            'perfil_idperfil' => $this->perfil_idperfil,
            'evento_idevento' => $this->evento_idevento,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
