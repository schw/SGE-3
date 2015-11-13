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
        return $this->render('index');
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
    
    public function actionUsuario(){
    	echo '<script language="javascript">';
    	if(Yii::$app->user->identity->tipoUsuario === 3){ 
    		echo 'alert("mensagem vinda do usuario")';
    		echo '</script>';
    		return $this->render('usuario',['model'=> Yii::$app->user->identity]);
    	}elseif(Yii::$app->user->identity->tipoUsuario === 2){
    		echo 'alert("mensagem vinda do secretario")';
    		echo '</script>';
    		return $this->render('secretaria',['model'=> Yii::$app->user->identity]);
    	}else{
    		echo 'alert("mensagem vinda do coordenador")';
    		echo '</script>';
    		return $this->render('coordenador',['model'=> Yii::$app->user->identity]);
    	//return $this->goBack();
    
    	}
    }
    
    public function actionCoordenador(){
    	echo '<script language="javascript">';
    	echo 'alert("mensagem vinda do actionCoordenador")';
    	echo '</script>';
    	return $this->render('coordenador',['model'=> Yii::$app->user->identity]);
    	//return $this->goBack();
    }
    
    public function actionSecretaria(){
    	echo '<script language="javascript">';
    	echo 'alert("mensagem vinda do actionSecretaria")';
    	echo '</script>';
    	return $this->render('secretaria',['model'=> Yii::$app->user->identity]);
    	//return $this->goBack();
    }
    
    public function actionRecuperar(){
    	    if ( Yii::$app->request->post())
        {
            $model;
            $email = Yii::$app->request->post('email');
            $usuario = User::find()->where(['email'=>$email])->one();
            //$usuario = User::findByEmail($email);
            if($usuario===null){
                echo '<script language="javascript">';
                echo 'alert("Email invalido")';
                echo '</script>';
            }           
            if($usuario!=null && $usuario->tipoUsuario===3) //se o usuario com email informado existe...
            {
                echo '<script language="javascript">';
                echo 'alert("Email enviado")';
                echo '</script>';
                Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo($email)
                ->setSubject("Senha para o Sistema gerenciador de eventos")
                ->setTextBody("Sua senha é ".$usuario->senha)
                ->send();
                return $this->render('recuperar');
            }else{
                echo '<script language="javascript">';
                echo 'alert(você deve acessar o sge pelo portal do professor ou secretaria")';
                echo '</script>';
                return $this->render('recuperar');
                }
        }else{
            return $this->render('recuperar');
        }
    }
    
    public function actionRecupera(){
    	echo '<script language="javascript">';
    	echo 'alert("mensagem vinda do formulario")';
    	echo '</script>';
    	if ( Yii::$app->request->post())
    	{
    		$email = Yii::$app->request->post('email');
    		$usuario = User::find()->where(['email'=>$email])->one();
    		if($usuario!=null) //se o usuario com email informado existe...
    		{
    			echo '<script language="javascript">';
    			echo 'alert("mensagem vinda do recuperar")';
    			echo '</script>';
    			Yii::$app->mailer->compose()
    			->setFrom('wes.lima.23@gmail.com')
    			->setTo($email)
    			->setSubject('Senha SGE')
    			->setTextBody($usuario->senha)
    			->setHtmlBody('<b>HTML content</b>')
    			->send();
    		}
    	}
    	
    }
    
}
