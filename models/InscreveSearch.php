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

        
        if (!Yii::$app->user->isGuest) {
            $query = Inscreve::find()->where(['usuario_idusuario' => Yii::$app->user->identity->idusuario]);
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

        return $dataProvider;
    }

//não mexer, pois é referente ao Gerenciar Credenciamento
public function searchInscritos($params)
    {

        
        if (!Yii::$app->user->isGuest) {
            $query = Inscreve::find()->where(['evento_idevento' => $params['evento_idevento']]);
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
       return $dataProvider;
    }


//usado para gerar lista de crendenciados com a finalidade de imprimir certificados!!!
    public function searchCredenciados($params)
    {

        
        if (!Yii::$app->user->isGuest) {
            $query = Inscreve::find()->where(['evento_idevento' => $params['evento_idevento']])->andWhere(['credenciado' => 1]);
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
       return $dataProvider;
    }
}
