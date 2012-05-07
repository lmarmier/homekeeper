<?php

class EventController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('index','view','createWithXML'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','list','history','check'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('lion.mar'),
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

		//Nous mettons l'événement dans l'historique
		$event = $this->loadModel($id);
		$event->history = 1;

		//Si l'utilisateur à modifier un commentaire
		//CVarDumper::dump($_POST,10,true);
		if (isset($_POST['Event'])) {
			$event->comment = $_POST['Event']['comment'];
		}

		$event->save();

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
		$model=new Event;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Event']))
		{
			$model->attributes=$_POST['Event'];
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Event']))
		{
			$model->attributes=$_POST['Event'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
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

	
	/**
	 * Lists all models by home
	 */
	public function actionIndex($home_id = null)
	{
		if ($home_id != null) {
			$_SESSION['home_id'] = $home_id;
		}

		$dataProvider=new CActiveDataProvider('Event', array(
				'criteria' => array(
						'condition' => 'home_id='.$_SESSION['home_id']. ' AND history!=1 ',
						'order' => 'datetime DESC',
					),
			));

		//Récupération du nom de la maisons
		$model = new Home;
		$home_name = $model->findByAttributes(array('id'=>$_SESSION['home_id']))->name;

		$model=new Event('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Event']))
			$model->attributes=$_GET['Event'];
		$model->findAllByAttributes(array(
				'home_id'=>$_SESSION['home_id'],
			));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'home_name'=>$home_name,
			'model'=>$model,
		));
	}

	/**
	 * History of events
	 */
	public function actionHistory($gravity=null)
	{

		//Création de la condition
		$condition = ($gravity)?'AND gravity = "'. $gravity. '"':'';

		$dataProvider=new CActiveDataProvider('Event', array(
				'criteria' => array(
						'condition' => 'home_id='.$_SESSION['home_id']. ' AND history=1 '. $condition,
						'order' => 'datetime DESC',
					),
			));

		//Récupération du nom de la maisons
		$model = new Home;
		$home_name = $model->findByAttributes(array('id'=>$_SESSION['home_id']))->name;

		$this->render('history',array(
			'dataProvider'=>$dataProvider,
			'home_name'=>$home_name,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Event('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Event']))
			$model->attributes=$_GET['Event'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Event::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * This function pass a event in the history and redirect on index
	 */
	public function actionCheck($id)
	{
		$event = Event::model()->findByPk($id);
		$event->history = 1;
		if ($event->save()) {
			$this->redirect(array('/');
		}
	}

	/**
	 * Create a event with the xml in the post variable
	 * this action must replace the actionCreate in the future
	 *
	 * @param the xml file to save in database
	 */
	 public function actionCreateWithXML($xml=null)
	 {
	 	// Récupération du XML de la réponse
		// read from stdin instead as reading from a formular field,
		// thus, the POSTed request remains a valid XML document ! (MJN June 2011)
		// see also http://snipplr.com/view/755/read-raw-post-data-useful-for-grabbing-xml-from-flash-xmlsocket/
        // $xmlReply = $_POST['xml'];
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
		// Read the input from stdin
			$xml = trim(file_get_contents('php://input'));
		}

	 	/*
	 	 * Synthaxe du fichier XML devant être envoyé
	 	 *
	 	$xml = "<?xml version='1.0' encoding='utf-8'?>
	 			<!DOCTYPE hkp_request SYSTEM 'protected/data/hkp_request.dtd'>
				<hkp_request home_id='2147483647'>
					<!-- corps du fichier d'intervention -->
					<info type='watchdog'
           				value='control'
           				gravity='low'
          				comment='Control event'
           				datetime='2012-05-05 18:42:25'
            		/>
				</hkp_request>";

		//*/

		//Decode the file input
		$xml = rawurldecode($xml);
		$xml = str_replace('+', ' ', $xml);
		$xml = str_replace('request=', '', $xml);

		//Log the xml received
		Yii::log($xml);

		//create a document
		$document = new DomDocument();
		//load the xml reveived
		$document->loadXML($xml);
		//save the last document received
		$document->save('test.xml');

		//validate xml document
		/*try {
			$document->Validate();
		} catch (Exception $e) {
			echo $e;
		}
		//*/
		/*
		if ($document->Validate() == true) {
			throw new CHttpException(400, Yii::t('err', 'bad request'));
		}else{
			throw new CHttpException(400, Yii::t('err', 'bad request'));
		}
		//*/

		//Chargement du modèle
		$model = new Event;

		//Récupération du home_id
		$model->home_id = $document->getElementsByTagName('hkp_request')->item(0)->getAttribute('home_id');

		//Récupération du corp du fichier de l'intervention
		$info = $document->getElementsByTagName('info')->item(0);
		$model->type = $info->getAttribute('type');
		$model->value = $info->getAttribute('value');
		$model->gravity = $info->getAttribute('gravity');
		$model->comment = $info->getAttribute('comment');
		$model->datetime = $info->getAttribute('datetime');
		$model->history = 0;

		//Changement du layout pour retourner du xml
		$this->layout = "xml";

		if ($model->save()) {
			$this->render('return', array(
				'code'=>0,
			));
		}else{
			$this->render('return', array(
				'code'=>200,
			));
		}

	 }

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='event-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
