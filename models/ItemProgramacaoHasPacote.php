<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "itemProgramacao_has_pacote".
 *
 * @property integer $itemProgramacao_iditemProgramacao
 * @property string $pacote_idpacote
 *
 * @property ItemProgramacao $itemProgramacaoIditemProgramacao
 * @property Pacote $pacoteIdpacote
 */
class ItemProgramacaoHasPacote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'itemProgramacao_has_pacote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itemProgramacao_iditemProgramacao', 'pacote_idpacote'], 'required'],
            [['itemProgramacao_iditemProgramacao', 'pacote_idpacote'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'itemProgramacao_iditemProgramacao' => 'Item Programacao Iditem Programacao',
            'pacote_idpacote' => 'Pacote Idpacote',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemProgramacaoIditemProgramacao()
    {
        return $this->hasOne(ItemProgramacao::className(), ['iditemProgramacao' => 'itemProgramacao_iditemProgramacao']);
    }

    public function getItemProgramacao (){
        return $this->hasOne(ItemProgramacao::className(), ['iditemProgramacao' => 'itemProgramacao_iditemProgramacao']);

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPacoteIdpacote()
    {
        return $this->hasOne(Pacote::className(), ['idpacote' => 'pacote_idpacote']);
    }
}
