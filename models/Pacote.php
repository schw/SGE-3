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
            [['titulo', 'descricao', 'valor'], 'required'],
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
        ];
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
}
