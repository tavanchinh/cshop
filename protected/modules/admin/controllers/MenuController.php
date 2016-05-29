<?php

class MenuController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		$rules = Functional::model()->getPermmision($this->id);
        return $rules;
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
		$data = Yii::app()->request->getPost('data');
        $html = '';
        if($data != null && count($data) > 0){
            foreach($data as $value){
                if($value['type'] == 1){
                    $sql = "INSERT INTO menu(parent_id,title,slug,type,position) SELECT 0,name,slug,1,0 FROM page WHERE id =".$value['id'];
                    
                }elseif($value['type'] == 2){
                    $sql = "INSERT INTO menu(parent_id,title,slug,type,position) SELECT 0,name,slug,2,0 FROM category WHERE id =".$value['id'];
                }
                
                Yii::app()->db->createCommand($sql)->execute();
            }
            $html = Menu::model()->buidMenuTreeBackend();
            echo $html;
        }
	}
    
    public function actionCreateCustomLink(){
        $title = Yii::app()->request->getParam('title');
        $slug = Yii::app()->request->getParam('slug');
        if($title != ''){
            $menu = new Menu;
            $menu->title = $title;
            $menu->slug = $slug;
            $menu->position = 0;
            $menu->type = 3;
            $menu->save();
            
            
            $html = Menu::model()->buidMenuTreeBackend();
            echo $html;
        }
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		$structure = Yii::app()->request->getParam('structure');
        if($structure != null){
            $list = json_decode($structure,true);
            if(count($list) > 0){
                $i = 0;
                foreach($list as $value){
                    $i++;
                    $sql = "UPDATE menu SET parent_id = 0, position =$i WHERE id =".$value['id'];
                    Yii::app()->db->createCommand($sql)->execute();
                    if(isset($value['children'])){
                        $children = $value['children'];
                        if(count($children) > 0){
                            $j = $i+1;
                            foreach($children as $chid){
                                $j++;
                                $sql = "UPDATE menu SET parent_id = ".$value['id'].", position =$j WHERE id =".$chid['id'];
                                Yii::app()->db->createCommand($sql)->execute();
                            }
                        }
                    }
                }
            }
        }
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionRemove()
	{
		$id = Yii::app()->request->getPost('id');
        $this->loadModel($id)->delete();

	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Menu');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);
        }
        $model=new Menu('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Menu']))
			$model->attributes=$_GET['Menu'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Menu the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Menu::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Menu $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='menu-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
