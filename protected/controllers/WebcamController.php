<?php

class WebcamController extends Controller
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
				'actions'=>array('index','view','create', 'img', 'delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Webcam;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Webcam']))
		{
			$model->attributes=$_POST['Webcam'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['Webcam']))
		{
			$model->attributes=$_POST['Webcam'];
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
	public function actionIndex($home_id = null)
	{

		if ($home_id) {
			$_SESSION['home_id'] = $home_id;
		}

		//If nothing home is selected we redirect on the homes list
		if (!isset($_SESSION['home_id'])) {
			Yii::app()->user->setFlash('noHome', 'Vous devez au préalable séléctionner une résidence afin de consulter ses webcams');
			$this->redirect(array('/home'));
		}

		$dataProvider=new CActiveDataProvider('Webcam',
			array('criteria' => array(
						'condition' => 'home_id='.$_SESSION['home_id'],
					),
			'pagination'=>array(
						'pageSize'=>3,
					),
			));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionImg($id){
		$this->render('img',array(
			'id'=>$id,
		));
	}

	/**
	 * Manages all models.
	 */
	 /*
	public function actionAdmin()
	{
		$model=new Webcam('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Webcam']))
			$model->attributes=$_GET['Webcam'];

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
		$model=Webcam::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='webcam-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
