<?php

class FunctionalController extends Controller
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
		$model=new Functional;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Functional']))
		{
			$model->attributes=$_POST['Functional'];
         $explode_url = explode('/',$model->url);
         
         $count_explode = count($explode_url);
         $model->controller_id = isset($explode_url[$count_explode-2]) ? $explode_url[$count_explode-2] : null;
         $model->action_id = isset($explode_url[$count_explode-1]) ? $explode_url[$count_explode-1] : null;
         //CVarDumper::dump($model->attributes,10,true);die();
			if($model->save())
				$this->redirect(array('admin'));
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

		if(isset($_POST['Functional']))
		{
			$model->attributes=$_POST['Functional'];
			$explode_url = explode('/',$model->url);
         
         $count_explode = count($explode_url);
         $model->controller_id = isset($explode_url[$count_explode-2]) ? $explode_url[$count_explode-2] : null;
         $model->action_id = isset($explode_url[$count_explode-1]) ? $explode_url[$count_explode-1] : null;
         //CVarDumper::dump($model->attributes,10,true);die();
         if($model->save())
				$this->redirect(array('admin'));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Functional');
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
      $model=new Functional('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Functional']))
			$model->attributes=$_GET['Functional'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Functional the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Functional::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Functional $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='functional-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
