<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "itemprogramacao".
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
 * @property integer $tipo_idtipo
 *
 * @property Evento $eventoIdevento
 * @property Local $localIdlocal
 * @property Tipo $tipoIdtipo
 * @property ItemprogramacaoHasPacote[] $itemprogramacaoHasPacotes
 * @property Pacote[] $pacoteIdpacotes
 * @property ItemprogramacaoHasVoluntario[] $itemprogramacaoHasVoluntarios
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
            [['titulo', 'descricao', 'vagas', 'cargaHoraria', 'local_idlocal', 'evento_idevento'], 'required', 'message'=>'Este campo é obrigatório'],
            [['hora'], 'safe'],
            [['vagas', 'cargaHoraria','palestrante_idPalestrante', 'local_idlocal', 'evento_idevento', 'tipo_idtipo'], 'integer'],
            [['data'], 'string'],
            [['data'], 'validateDate'],
            [['titulo', 'notificacao'], 'string', 'max' => 150],
            [['descricao'], 'string', 'max' => 300],
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
            'data' => '*Data',
            'hora' => '*Hora',
            'vagas' => '*Vagas',
            'cargaHoraria' => '*Carga Horária',
            'detalhe' => 'Detalhe',
            'notificacao' => 'Notificação',
            'palestrante_idPalestrante' => 'Palestrante',
            'local_idlocal' => 'Localização',
            'evento_idevento' => 'Evento',
            'tipo.titulo' => 'Tipo',
            'local.descricao' => 'Local',
            'evento.descricao' => 'Evento',
            'tipo_idtipo' => 'Tipo'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function validateDate($attribute, $params){
        if (!$this->hasErrors()) {
            if ($this->data < date('Y-m-d')) {
                $this->addError($attribute, 'Informe uma data igual ou posterior a '.date('d-m-Y'));
            }
        }
    }

    public function getPalestrante()
    {
        return $this->hasOne(Palestrante::className(), ['idPalestrante' => 'palestrante_idPalestrante']);
    }


    public function getEventoIdevento()
    {
        return $this->hasOne(Evento::className(), ['idevento' => 'evento_idevento']);
    }

     public function getEvento()
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
    public function getTipoIdtipo()
    {
        return $this->hasOne(Tipo::className(), ['idtipo' => 'tipo_idtipo']);
    }

    public function getTipo()
    {
        return $this->hasOne(Tipo::className(), ['idtipo' => 'tipo_idtipo']);
    }

    public function getLocal()
    {
        return $this->hasOne(Local::className(), ['idlocal' => 'local_idlocal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemprogramacaoHasPacotes()
    {
        return $this->hasMany(ItemprogramacaoHasPacote::className(), ['itemProgramacao_iditemProgramacao' => 'iditemProgramacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPacoteIdpacotes()
    {
        return $this->hasMany(Pacote::className(), ['idpacote' => 'pacote_idpacote'])->viaTable('itemprogramacao_has_pacote', ['itemProgramacao_iditemProgramacao' => 'iditemProgramacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemprogramacaoHasVoluntarios()
    {
        return $this->hasMany(ItemprogramacaoHasVoluntario::className(), ['itemProgramacao_iditemProgramacao' => 'iditemProgramacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVoluntarioIdvoluntarios()
    {
        return $this->hasMany(Voluntario::className(), ['idvoluntario' => 'voluntario_idvoluntario'])->viaTable('itemprogramacao_has_voluntario', ['itemProgramacao_iditemProgramacao' => 'iditemProgramacao']);
    }
}
