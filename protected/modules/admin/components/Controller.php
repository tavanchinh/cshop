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
	public $layout='//layouts/admin/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    
    public function beforeAction($action){
        
        return true;
    }
    
    
    public function init(){
        
        
        
        
        
        $path_info = Yii::app()->request->getPathInfo();
        if(Yii::app()->session['admin_id'] == null && $path_info != 'admin/default/login' && $path_info != 'admin/default/captcha' ){
            $this->redirect('/admin/default/login?rel=/'.$path_info);
        }
    }
}