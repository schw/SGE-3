<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\base\Model;
use app\models\User;
use app\models\EventoSearch;
use yii\helpers\Html;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
       $this->redirect(['evento/index']);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }
        
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    
    public function actionRecuperar(){
		if ( Yii::$app->request->post()){
            $model;
            $email = Yii::$app->request->post('email');
            $usuario = User::find()->where(['email'=>$email])->one();
            //$usuario = User::findByEmail($email);
            if($usuario===null){
                echo '<script language="javascript">';
                echo 'alert("Informe um Email v√°lido")';
                echo '</script>';
                return $this->render('recuperar');
            }           
            if($usuario!=null && $usuario->tipoUsuario===3) //se o usuario com email informado existe...
            {
            	try{
	            	$senha = $this->geraSenha(8);
	            	$usuario->senha = $senha;
	            	$usuario->save(false);
	                echo '<script language="javascript">';
	                echo 'alert("Email enviado")';
	                echo '</script>';
	                Yii::$app->mailer->compose()
	                ->setFrom(Yii::$app->params['adminEmail'])
	                ->setTo($email)
	                ->setSubject("[SGE] Recupera√ß√£o de Senha")
	                ->setTextBody("ServiÁo de RecuperaÁ„o de senha"."\n\n"."Ol· ".$usuario->nome.", vocÍ solicitou a recuperaÁ„o da sua senha. Geramos automaticamente uma nova senha de acesso para vocÍ. \nPor favor efetue o login no sistema com esta nova senha e modifique-a se achar necess·rio:\n\nSenha: ".$senha)
	                ->send();
	            	return $this->goHome();
            	}catch (\Exception $e){
            		echo '<script language="javascript">';
            		echo 'alert("Um erro ocorreu por favor tente novamente mais tarde)';
            		echo '</script>';
            		return $this->render('recuperar');
            	}
	    	}else{
                echo '<script language="javascript">';
                echo 'alert("Somente participantes podem recuperar senha")';
                echo '</script>';
                return $this->render('recuperar');
                }
        }else{
            return $this->render('recuperar');
        }
    }
    
    function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = true)
    {
    	$lmin = 'abcdefghijklmnopqrstuvwxyz';
    	$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$num = '1234567890';
    	//$simb = '!@#$%*-';
    	$retorno = '';
    	$caracteres = '';
    	$caracteres .= $lmin;
    	if ($maiusculas) $caracteres .= $lmai;
    	if ($numeros) $caracteres .= $num;
    	//if ($simbolos) $caracteres .= $simb;
    	$len = strlen($caracteres);
    	for ($n = 1; $n <= $tamanho; $n++) {
    		$rand = mt_rand(1, $len);
    		$retorno .= $caracteres[$rand-1];
    	}
    	return $retorno;
    }
    
}
