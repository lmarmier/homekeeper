<?php

class HomeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//homekeeper/column2', meaning
	 * using two-column layout. See 'protected/views/homekeeper/column2.php'.
	 */
	public $layout='//homekeeper/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(''),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{	

		if ($id != null) {
			$_SESSION['home_id'] = $id;
		}

		//If nothing home is selected we redirect on the homes list
		if (!isset($_SESSION['home_id'])) {
			Yii::app()->user->setFlash('noHome', 'Vous devez au préalable séléctionner une résidences afin de consulter sa page');
			$this->redirect(array('/home'));
		}

		$dataProvider = new CActiveDataProvider('Event',
			array(
				'criteria'=>array(
					'condition'=>'history=0',
					'with'=>array(
						'home'=>array(
							'condition'=>'home_id='.$id,
						),
					),
					'order'=>'datetime DESC',
				),
				'pagination'=>array(
					'pageSize'=>14,
				),
			)
		);

		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'dataProvider'=>$dataProvider,
			'webcams'=>Webcam::model()->findAllByAttributes(array('home_id'=>$id)),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Home;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Home']))
		{
			$model->attributes=$_POST['Home'];
			$model->image=CUploadedFile::getInstance($model, 'image');
			if($model->save()){
				$model->image->saveAs('images/home/'. $model->id. '.'. $model->image->getExtensionName());
				$this->redirect(array('index'));
			}
		}

		//Récupérons l'id de l'utilisateur connecté
		$id = User::model()->findByAttributes(array('username'=>Yii::app()->user->id))->id;

		$this->render('create',array(
			'model'=>$model,
			'id'=>$id,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	 
	 /*
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Home']))
		{
			$model->attributes=$_POST['Home'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	//*/

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	 
	 /*
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	//*/

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		//Récupérons l'id de l'utilisateur connecté
		$id = User::model()->findByAttributes(array('username'=>Yii::app()->user->id))->id;

		$dataProvider=new CActiveDataProvider('Home', array(
				'criteria' => array(
						'condition' => 'user_id='.$id,
					),
			));
		$this->render('index', array(
				'dataProvider' => $dataProvider,
			));
	}

	/**
	 * Manages all models.
	 */
	 /*
	public function actionAdmin()
	{
		$model=new Home('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Home']))
			$model->attributes=$_GET['Home'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	//*/

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Home::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='home-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
