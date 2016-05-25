<?php

class OrdersController extends Controller
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
		$model=new Orders;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Orders']))
		{
			$model->attributes=$_POST['Orders'];
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

		if(isset($_POST['Orders']))
		{
			$model->attributes=$_POST['Orders'];
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
		$dataProvider=new CActiveDataProvider('Orders');
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
        $model=new Orders('search');
		$model->unsetAttributes();  // clear any default values
        
        $view_mode = Yii::app()->request->getParam('view','all');
        $list_count_by_status = Orders::model()->countGroupStatus();
        
        switch($view_mode){
            case 'new':
                $model->status = 0;
                break;
            case 'processing':
                $model->status = 1;
                break;
            case 'complete':
                $model->status = 2;
                break;
            case 'cancel':
                $model->status = 3;
                break;
            default:
                $model->status = null;
                break;
        }
		if(isset($_GET['Orders']))
			$model->attributes=$_GET['Orders'];

		$this->render('admin',array(
			'model'=>$model,
            'view_mode' => $view_mode,
            'list_count_by_status' => $list_count_by_status,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Orders the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Orders::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Orders $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='orders-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function gridInfo($data,$row){
        $html = '';
        $id = '<a href="/admin/orders/update/id/'.$data->id.'" >#'.$data->id.'</a>';
        $customer = ' <strong>'.$data->full_name.'</strong><br />';
        $phone_number = '<div style="margin:5px 0 0 0;">'.$data->phone_number.'</div>';
        $email = '<a href="mailto:'.$data->email.'">'.$data->email.'</a>';
        $html = $id.$customer.$phone_number.$email;
        return $html;
    }
    
    public function gridPurchased($data,$row){
        $sql = "SELECT COUNT(*) FROM orders_product WHERE orders_id={$data->id}";
        $count = Yii::app()->db->createCommand($sql)->queryScalar();
        return $count . ' sản phẩm';
    }
    
    public function gridAmount($data,$row){
        $sql = "select SUM(price*qty) FROM product a INNER JOIN orders_product b ON a.id = b.product_id WHERE b.orders_id ={$data->id}";
        $amount = Yii::app()->db->createCommand($sql)->queryScalar();
        return Str::formatNumber($amount) .' '. Product::model()->currency;
    }
}
