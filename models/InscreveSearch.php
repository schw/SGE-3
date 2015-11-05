<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inscreve;

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
            [['credenciado'], 'safe'],
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
}
