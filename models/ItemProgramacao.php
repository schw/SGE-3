<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "itemProgramacao".
 *
 * @property integer $iditemProgramacao
 * @property string $titulo
 * @property string $descricao
 * @property string $palestrante
 * @property string $data
 * @property string $hora
 * @property integer $vagas
 * @property integer $cargaHoraria
 * @property string $detalhe
 * @property string $notificacao
 * @property integer $local_idlocal
 * @property string $evento_idevento
 *
 * @property Evento $eventoIdevento
 * @property Local $localIdlocal
 * @property ItemProgramacaoHasPacote[] $itemProgramacaoHasPacotes
 * @property Pacote[] $pacoteIdpacotes
 * @property ItemProgramacaoHasVoluntario[] $itemProgramacaoHasVoluntarios
 * @property Voluntario[] $voluntarioIdvoluntarios
 */
class ItemProgramacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'itemProgramacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'descricao', 'palestrante', 'data', 'hora', 'vagas', 'cargaHoraria', 'local_idlocal'], 'required', 'message'=>'Este campo é obrigatório'],
            [['iditemProgramacao', 'vagas', 'cargaHoraria', 'local_idlocal', 'evento_idevento'], 'integer'],
            [['hora'], 'safe'],
            [['titulo', 'descricao', 'palestrante', 'notificacao'], 'string', 'max' => 45],
            [['data'], 'string', 'max' => 10],
            [['detalhe'], 'string', 'max' => 800]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iditemProgramacao' => 'Iditem Programacao',
            'titulo' => '*Título',
            'descricao' => '*Descrição',
            'palestrante' => '*Palestrante',
            'data' => '*Data',
            'hora' => '*Hora',
            'vagas' => '*Vagas',
            'cargaHoraria' => '*Carga Horária',
            'detalhe' => 'Detalhe',
            'notificacao' => 'Notificacao',
            'local_idlocal' => '*Localidade',
            'evento_idevento' => 'Evento Idevento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventoIdevento()
    {
        return $this->hasOne(Evento::className(), ['idevento' => 'evento_idevento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocalIdlocal()
    {
        return $this->hasOne(Local::className(), ['idlocal' => 'local_idlocal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemProgramacaoHasPacotes()
    {
        return $this->hasMany(ItemProgramacaoHasPacote::className(), ['itemProgramacao_iditemProgramacao' => 'iditemProgramacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPacoteIdpacotes()
    {
        return $this->hasMany(Pacote::className(), ['idpacote' => 'pacote_idpacote'])->viaTable('itemProgramacao_has_pacote', ['itemProgramacao_iditemProgramacao' => 'iditemProgramacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemProgramacaoHasVoluntarios()
    {
        return $this->hasMany(ItemProgramacaoHasVoluntario::className(), ['itemProgramacao_iditemProgramacao' => 'iditemProgramacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVoluntarioIdvoluntarios()
    {
        return $this->hasMany(Voluntario::className(), ['idvoluntario' => 'voluntario_idvoluntario'])->viaTable('itemProgramacao_has_voluntario', ['itemProgramacao_iditemProgramacao' => 'iditemProgramacao']);
    }
}
