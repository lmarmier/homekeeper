<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//homekeeper/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var string title sidebar. This property will be assigned to {@link CPortlet::title}.
	 */
	public $titleSidebar='';
	/**
	 * @var string intro text sidebar. This property will be assigned to {@link CPortlet::title}.
	 */
	public $contentSidebar='';
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	/**
	 * Check if user is authorized to access at this home
	 * If not access, a httpException is thrown
	 */
	 public function beforeAction($action){
		if(isset($_SESSION['home_id'])){
			$homeUserId = Home::model()->findByPk($_SESSION['home_id'])->user_id;
			$id = User::model()->findByAttributes(array('username'=>Yii::app()->user->id))->id;

			if($homeUserId !== $id){
				throw new CHttpException('400', 'Vous n\'avez pas les droit d\'acc�s � cette page.');
			}
		}
		return true;
	 }
}