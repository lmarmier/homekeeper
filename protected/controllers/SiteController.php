<?php

class SiteController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//homekeeper/column2', meaning
	 * using two-column layout. See 'protected/views/homekeeper/column2.php'.
	 */
	public $layout='//homekeeper/column1';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		//Si l'utilisateur est déjà connécté, nous le redirigons sur sa page
		if (!Yii::app()->user->isGuest) {
			$this->redirect(array('/user/home'));
		}

		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$model = new LoginForm;

		$this->render('index', array(
			'model'=>$model,
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	 /*
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	//*/


	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(array('/'));
		}
		// display the login form
		//$this->render('login',array('model'=>$model));
		$this->redirect(array('/'));
	}

	/**
	 * Display the login page to management of users
	 */

	public function actionUserLogin(){
		$model=new LoginForm;

		//if user is connected, redirect on homePage
		if (!Yii::app()->user->isGuest) {
			$this->redirect(array('/user'));
		}

		//if it's ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax']==='login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		//Collect user input data
		if (isset($_POST['LoginForm'])) {
			$model->attributes=$_POST['LoginForm'];
			//Validate user input and redirect on the users management page
			if ($model->validate() && $model->login()){
				$_SESSION['admin'] = true;
				$this->redirect(array('/user/admin'));
			}
		}

		//Display the login form
		$this->render('userLogin', array('model'=>$model));

	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}