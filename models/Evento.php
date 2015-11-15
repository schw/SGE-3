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
            [['dataIni', 'dataFim'], 'string',],
            [['dataIni'], 'validateDateIni'],
            [['dataFim'], 'validateDateFim'],
            [['horaIni', 'horaFim'], 'safe'],
            [['horaFim'], 'validadeHoraFim'],
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
            'tipo.titulo' => 'Tipo',
            'local_idlocal' => '*Local',
            'local.descricao' => 'Local',
            'credenciado' => 'Credenciado'
        ];
    }

    public function validateDateIni($attribute, $params){
        if (!$this->hasErrors()) {
            if ($this->dataIni < date('Y-m-d')) {
                $this->addError($attribute, 'Informe uma data igual ou posterior a '.date('d-m-Y'));
            }
        }
    }

    public function validateDateFim($attribute, $params){
        if (!$this->hasErrors()) {
            if ($this->dataFim < $this->dataIni) {
                $this->addError($attribute, 'Informe uma data igual ou posterior a '.date("d-m-Y", strtotime($this->dataIni)));
            }
        }
    }

    public function validadeHoraFim($attribute, $params){
        if (!$this->hasErrors()) {
            if ($this->horaFim <= $this->horaIni) {
                $this->addError($attribute, 'Informe um horário acima do horário inicial');
            }
        }
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

    /*Verifica se o evento está ativo*/
    public function canWrite(){
        return $this->dataFim > date('Y-m-d') && Yii::$app->user->identity->idusuario == $this->responsavel ? true : false;
    }

    public function beforeDelete(){
        if((new PacoteSearch())->searchEventoPacote($this->idevento)->count > 0)
            if(!Pacote::deleteAll(['evento_idevento' => $this->idevento]) && !ItemProgramacao::deleteAll(['evento_idevento' => $this->idevento]))
                return false;
        return true;
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
    public function getInscreve()
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


    public function getLocal()
    {
        return $this->hasOne(Local::className(), ['idlocal' => 'local_idlocal']);
    }
    
}
