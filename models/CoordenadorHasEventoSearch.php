<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CoordenadorHasEvento;

/**
 * CoordenadorHasEventoSearch represents the model behind the search form about `app\models\CoordenadorHasEvento`.
 */
class CoordenadorHasEventoSearch extends CoordenadorHasEvento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_idusuario', 'evento_idevento'], 'integer'],
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
    public function search($idevento)
    {
        $query = CoordenadorHasEvento::find()->where(['evento_idevento' => $idevento]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'usuario_idusuario' => $this->usuario_idusuario,
            'evento_idevento' => $this->evento_idevento,
        ]);

        return $dataProvider;
    }

    /*lista todos os coordenadores exceto o usuario autenticado*/
    public function searchCoordenadores(){
        $query = User::find()->where('tipoUsuario = 1')->orWhere('tipoUsuario = 2')->andWhere("idusuario != '".Yii::$app->user->identity->tipoUsuario."'");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'usuario_idusuario' => $this->usuario_idusuario,
            'evento_idevento' => $this->evento_idevento,
        ]);

        return $dataProvider;
    }
}
