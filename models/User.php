<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $idusuario
 * @property string $nome
 * @property string $senha
 * @property string $cracha
 * @property string $email
 * @property string $instituicao
 * @property integer $tipoUsuario
 * @property integer $notificarViaEmail
 * @property string $authKey
 * @property string $accessToken
 *
 * @property Evento[] $eventos
 * @property Inscreve[] $inscreves
 * @property Evento[] $eventoIdeventos
 */

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
    	return 'user';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
    	return [
    			[[ 'nome', 'senha', 'email'], 'required'],
    			[['tipoUsuario', 'notificarViaEmail'], 'integer'],
    			[['nome'], 'string', 'max' => 50],
    			[['senha', 'cracha', 'email', 'instituicao'], 'string', 'max' => 45],
    			[['authKey', 'accessToken'], 'string', 'max' => 255],
    			[['email'], 'unique']
    	];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
    	return [
    			'idusuario' => 'Idusuario',
    			'nome' => 'Nome',
    			'senha' => 'Senha',
    			'cracha' => 'Cracha',
    			'email' => 'Email',
    			'instituicao' => 'Instituicao',
    			'tipoUsuario' => 'Tipo Usuario',
    			'notificarViaEmail' => 'Notificar Via Email',
    			'authKey' => 'Auth Key',
    			'accessToken' => 'Access Token',
    	];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
    	return $this->hasMany(Evento::className(), ['responsavel' => 'idusuario']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInscreves()
    {
    	return $this->hasMany(Inscreve::className(), ['usuario_idusuario' => 'idusuario']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventoIdeventos()
    {
    	return $this->hasMany(Evento::className(), ['idevento' => 'evento_idevento'])->viaTable('inscreve', ['usuario_idusuario' => 'idusuario']);
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
    	//echo '<script language="javascript">';
    	//echo 'alert("message '. $id .' successfully sent")';
    	//echo '</script>';
        /*return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;*/
    	return static::findOne(['email'=>$id]);
    	//return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
       return static::findOne(['accessToken'=>$token]);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    
    public static function findByNome($nome)
    {
    	/*foreach (self::$users as $user) {
    	 if (strcasecmp($user['username'], $username) === 0) {
    	 return new static($user);
    	 }
    	 }*/
    	return static::findOne(['nome'=>$nome]);
    
    }
    
    public static function findByEmail($email)
    {
        /*foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }*/
    	return static::findOne(['email'=>$email]);

    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->senha === $password;
    }
}
