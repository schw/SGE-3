<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pacote".
 *
 * @property integer $idpacote
 * @property string $titulo
 * @property string $descricao
 * @property double $valor
 * @property string $status
 * @property integer $evento_idevento
 *
 * @property Inscreve[] $inscreves
 * @property ItemProgramacaoHasPacote[] $itemProgramacaoHasPacotes
 * @property ItemProgramacao[] $itemProgramacaoIditemProgramacaos
 * @property Evento $eventoIdevento
 */
class Pacote extends \yii\db\ActiveRecord
{
    var $itens = "";
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pacote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'descricao', 'valor', 'itens'], 'required'],
            [['valor'], 'string'],
            [['titulo', 'descricao'], 'string', 'max' => 45],
            [['status'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idpacote' => 'Idpacote',
            'titulo' => 'Titulo',
            'descricao' => 'Descricao',
            'valor' => 'Valor',
            'status' => 'Status',
            'evento_idevento' => 'Evento Idevento',
            'itens' => 'Itens Programação'
        ];
    }

    public function afterSave(){
        try {
            foreach ($this->itens as $key => $value) {
                $itemProgramacao = $this->itens[$key];
                $pacote = $this->idpacote;
                $sql = "INSERT INTO itemProgramacao_has_pacote (itemProgramacao_iditemProgramacao, pacote_idpacote) VALUES ($itemProgramacao, $pacote);";
                Yii::$app->db->createCommand($sql)->execute();
            }
        } catch (ErrorException $e) {
            return false;
        }
    }

    public function beforeDelete(){
        try{
            $sql = "DELETE FROM itemProgramacao_has_pacote WHERE pacote_idpacote = '$this->idpacote'";
            Yii::$app->db->createCommand($sql)->execute();
        } catch (ErrorException $e){
            Yii::$app->session->setFlash('Falha', 'Erro ao remover Itens de Programacao');
            return false;
        }
        return true;
    }

    public function beforeUpdate()
    {
        //$this->itens = ItemProgramacaoHasPacote::find()->where(['pacote_idpacote' => $this->idpacote]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInscreves()
    {
        return $this->hasMany(Inscreve::className(), ['pacote_idpacote' => 'idpacote']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemProgramacaoHasPacotes()
    {
        return $this->hasMany(ItemProgramacaoHasPacote::className(), ['pacote_idpacote' => 'idpacote']);
    }

    public function getItemProgramacaoHasPacote()
    {
        return $this->hasMany(ItemProgramacaoHasPacote::className(), ['pacote_idpacote' => 'idpacote']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemProgramacaoIditemProgramacaos()
    {
        return $this->hasMany(ItemProgramacao::className(), ['iditemProgramacao' => 'itemProgramacao_iditemProgramacao'])->viaTable('itemProgramacao_has_pacote', ['pacote_idpacote' => 'idpacote']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventoIdevento()
    {
        return $this->hasOne(Evento::className(), ['idevento' => 'evento_idevento']);
    }

    public function getEvento()
    {
        return $this->hasOne(Evento::className(), ['idevento' => 'evento_idevento']);
    }


    public function getPacote($id_usuario,$id_evento){

        $id_evento = Yii::$app->request->post('evento_idevento'); 

        return $results = Pacote::find()->where(['evento_idevento' => $id_evento , 'usuario_idusuario' => $id_usuario]);

    }

}
