<?php

class WebconfigController extends Controller
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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		$id = 1;
        $model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        
		if(isset($_POST['WebConfig']))
		{
			$model->attributes=$_POST['WebConfig'];
            $check = getimagesize($_FILES["logo"]["tmp_name"]);
            if($check !== false) {
                $target_file = Yii::getPathOfAlias('webroot').'\images\logo.png';
                move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file);
            }
			if($model->save())
				$this->redirect(array('update'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return WebConfig the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=WebConfig::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param WebConfig $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='web-config-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
