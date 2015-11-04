<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "evento".
 *
 * @property string $idevento
 * @property string $sigla
 * @property string $descricao
 * @property string $dataIni
 * @property string $dataFim
 * @property string $horaIni
 * @property string $horaFim
 * @property integer $vagas
 * @property integer $cargaHoraria
 * @property string $imagem
 * @property string $detalhe
 * @property integer $allow
 * @property integer $responsavel
 *
 * @property Usuario $responsavel0
 * @property Inscreve[] $inscreves
 * @property Usuario[] $usuarioIdusuarios
 * @property ItemProgramacao[] $itemProgramacaos
 * @property Pacote[] $pacotes
 */
class Evento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'evento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sigla', 'descricao', 'dataIni', 'dataFim', 'horaIni', 'horaFim', 'cargaHoraria', 'allow', 
            'responsavel', 'tipo_idtipo', 'local_idlocal'], 'required', 'message' => 'Este campo é Obrigatório'],
            [['vagas', 'cargaHoraria', 'allow', 'responsavel', 'tipo_idtipo', 'local_idlocal'], 'integer'],
            [['dataIni', 'dataFim'], 'string'],
            [['horaIni', 'horaFim'], 'safe'],
            [['sigla', 'descricao'], 'string', 'max' => 45],
            [['imagem'], 'string'],
            [['detalhe'], 'string', 'max' => 800],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idevento' => 'Idevento',
            'sigla' => '*Sigla',
            'descricao' => '*Descricao',
            'dataIni' => '*Data Inicial',
            'dataFim' => '*Data Final',
            'horaIni' => '*Hora Inicial',
            'horaFim' => '*Hora Final',
            'vagas' => 'Vagas',
            'cargaHoraria' => '*Carga Horária',
            'imagem' => 'Imagem',
            'detalhe' => 'Detalhe',
            'allow' => '*Status',
            'responsavel' => '*Responsável',
            'tipo_idtipo' => '*Tipo',
            'local_idlocal' => '*Local',
        ];
    }


    public function upload($imageFile)
    {
        if ($imageFile != null) {
            $imageName = date('dmYhms');
            $imageFile->saveAs('uploads/' . $imageName . '.' . $imageFile->extension);
            return $imageName.".".$imageFile->extension;
        } else {
            return null;
        }
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsavel0()
    {
        return $this->hasOne(User::className(), ['idusuario' => 'responsavel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInscreves()
    {
        return $this->hasMany(Inscreve::className(), ['evento_idevento' => 'idevento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioIdusuarios()
    {
        return $this->hasMany(User::className(), ['idusuario' => 'usuario_idusuario'])->viaTable('inscreve', 
            ['evento_idevento' => 'idevento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemProgramacaos()
    {
        return $this->hasMany(ItemProgramacao::className(), ['evento_idevento' => 'idevento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPacotes()
    {
        return $this->hasMany(Pacote::className(), ['evento_idevento' => 'idevento']);
    }

    public function getTipo()
    {
        return $this->hasOne(Tipo::className(), ['idtipo' => 'tipo_idtipo']);
    }

/*
    public function getLocal()
    {
        return $this->hasOne(Usuario::className(), ['idusuario' => 'responsavel']);
    }
    */
}
