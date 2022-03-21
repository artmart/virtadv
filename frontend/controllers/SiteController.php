<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

use frontend\models\Taskresponses;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'index'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index', 'preopeningsave', 'prepsave', 'closingsave'],
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

    /**
     * {@inheritdoc}
     */
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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionPreopeningsave()
    {
        $pre_opening = $this->request->post();  
        
        $pre_opening_note = $pre_opening['pre_opening_note'];       
        $user_id = Yii::$app->user->id;
        $today = date("Y-m-d h:i:s");
        $keys = [];
        foreach($pre_opening['pre_opening'] as $key=>$po){
            $keys[] = $key;
            $available_data = Taskresponses::find()->Where(" user_id = $user_id And task_id = $key And response=$po and DATE_FORMAT(TIMESTAMP, '%Y-%m-%d') = DATE_FORMAT('$today', '%Y-%m-%d')")->all();
            $cnt = count($available_data);
            
            if($cnt==0){
                $model = new Taskresponses();
                $model->user_id = $user_id;
                $model->task_id = $key;
                $model->timestamp = $today;
                $model->response = $po;
                $model->note = $pre_opening_note[$key];
                $model->save();
            }else if($available_data[0]->note!==$pre_opening_note[$key]){
                $available_data[0]->note=$pre_opening_note[$key];
                $available_data[0]->save(); 
            }
        }
        /*
        $keys_list = implode("', '", $keys); 
        $delete_sql = "DELETE FROM task_responses 
                       WHERE user_id = $user_id And task_id Not IN('$keys_list') 
                       And DATE_FORMAT(TIMESTAMP, '%Y-%m-%d') = DATE_FORMAT('$today', '%Y-%m-%d') 
                       AND task_id IN (SELECT id FROM tasks WHERE task_group = 0)";
                                
        //\Yii::$app->db->createCommand($delete_sql)->execute();*/
        echo '<div class="alert alert-success"><strong>Success!</strong> Data saved successfully.</div>';
    }
    
    public function actionPrepsave()
    {
        $prep = $this->request->post();
        $prep_note = $prep['prep_note'];  
        $user_id = Yii::$app->user->id;
        $today = date("Y-m-d h:i:s");
        $keys = [];
        foreach($prep['prep'] as $key=>$p){
            $keys[] = $key;
            $available_data = Taskresponses::find()->Where(" user_id = $user_id And task_id = $key And response=$p and DATE_FORMAT(TIMESTAMP, '%Y-%m-%d') = DATE_FORMAT('$today', '%Y-%m-%d')")->all();
            $cnt = count($available_data);
            
            if($cnt==0){
                $model = new Taskresponses();
                $model->user_id = $user_id;
                $model->task_id = $key;
                $model->timestamp = $today;
                $model->response = $p;
                $model->note = $prep_note[$key];
                $model->save();
            }else if($available_data[0]->note!==$prep_note[$key]){
                $available_data[0]->note=$prep_note[$key];
                $available_data[0]->save(); 
            }
        }
        /*$keys_list = implode("', '", $keys); 
        $delete_sql = "DELETE FROM task_responses 
               WHERE user_id = $user_id And task_id Not IN('$keys_list') 
               And DATE_FORMAT(TIMESTAMP, '%Y-%m-%d') = DATE_FORMAT('$today', '%Y-%m-%d') 
               AND task_id IN (SELECT id FROM tasks WHERE task_group = 1)";
               
        //\Yii::$app->db->createCommand($delete_sql)->execute();*/
        echo '<div class="alert alert-success"><strong>Success!</strong> Data saved successfully.</div>';  
    }
    
    public function actionClosingsave()
    {
        $closing = $this->request->post(); 
        $closing_note = $closing['closing_note']; 
        $user_id = Yii::$app->user->id;
        $today = date("Y-m-d h:i:s");
        $keys = [];
        foreach($closing['closing'] as $key=>$c){
            $keys[] = $key;
            $available_data = Taskresponses::find()->Where(" user_id = $user_id And task_id = $key And response=$c and DATE_FORMAT(TIMESTAMP, '%Y-%m-%d') = DATE_FORMAT('$today', '%Y-%m-%d')")->all();
            $cnt = count($available_data);
            
            if($cnt==0){
                $model = new Taskresponses();
                $model->user_id = $user_id;
                $model->task_id = $key;
                $model->timestamp = $today;
                $model->response = $c;
                $model->note = $closing_note[$key];
                $model->save();
            }else if($available_data[0]->note!==$closing_note[$key]){
                $available_data[0]->note=$closing_note[$key];
                $available_data[0]->save(); 
            }
        }
        /*$keys_list = implode("', '", $keys);
        $delete_sql = "DELETE FROM task_responses 
               WHERE user_id = $user_id And task_id Not IN('$keys_list') 
               And DATE_FORMAT(TIMESTAMP, '%Y-%m-%d') = DATE_FORMAT('$today', '%Y-%m-%d') 
               AND task_id IN (SELECT id FROM tasks WHERE task_group = 2)"; 
        //\Yii::$app->db->createCommand($delete_sql)->execute(); */   
        echo '<div class="alert alert-success"><strong>Success!</strong> Data saved successfully.</div>';
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', ['model' => $model]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
