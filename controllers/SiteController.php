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
        $eventoView = [];
        $searchModel = new EventoSearch();
        $eventos = $searchModel->searchEventos(Yii::$app->request->queryParams)->getModels();

        foreach ($eventos as $evento) {
            array_push($eventoView, ['label' => $evento->sigla, 'content' => ["<strong>Descrição: </strong>".$evento->descricao."
                <br><strong>Detalhe:</strong> ".$evento->detalhe, Html::a('Veja Mais', ['evento/view', 'id' => $evento->idevento], ['class' => 'btn'])]]);
        }

        return $this->render('index', [
                'eventos' => $eventoView,
            ]);
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
    	    if ( Yii::$app->request->post())
        {
            $model;
            $email = Yii::$app->request->post('email');
            $usuario = User::find()->where(['email'=>$email])->one();
            //$usuario = User::findByEmail($email);
            if($usuario===null){
                echo '<script language="javascript">';
                echo 'alert("Informe um Email válido")';
                echo '</script>';
            }           
            if($usuario!=null && $usuario->tipoUsuario===3) //se o usuario com email informado existe...
            {
            	$senha = $this->geraSenha(10);
                echo '<script language="javascript">';
                echo 'alert("Email enviado")';
                echo '</script>';
                Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo($email)
                ->setSubject("[SGE] Recuperação de Senha")
                ->setTextBody("Recuperar sua senha"."\n\n"."Olá ".$usuario->nome.", você solicitou a recuperação de senha, geramos uma nova senha de acesso para você: ".$senha)
                ->send();
                $usuario->senha = $senha;
                $usuario->save(false);
            	return $this->goHome();
	    }else{
                echo '<script language="javascript">';
                echo 'alert(Você deve acessar o SGE pelo portal do professor ou secretaria")';
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
    	$simb = '!@#$%*-';
    	$retorno = '';
    	$caracteres = '';
    	$caracteres .= $lmin;
    	if ($maiusculas) $caracteres .= $lmai;
    	if ($numeros) $caracteres .= $num;
    	if ($simbolos) $caracteres .= $simb;
    	$len = strlen($caracteres);
    	for ($n = 1; $n <= $tamanho; $n++) {
    		$rand = mt_rand(1, $len);
    		$retorno .= $caracteres[$rand-1];
    	}
    	return $retorno;
    }
    
}
