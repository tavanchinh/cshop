<?php

class SlideController extends Controller
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
	public function actionView()
	{
		$id = Yii::app()->request->getParam('id');
        $model = $this->loadModel($id);
        
        if($model != null){
            $data['title'] = $model->title;
            $data['link'] = $model->link;
            $data['position'] = $model->position;
            $data['checked'] = ($model->status == 1);
            $data['image'] = $model->image;
            $data['image_src'] = SimpleImage::model()->getThumbnail($model->image,150);
            
            echo json_encode($data);
        }
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$action = Yii::app()->request->getParam('action');
        $id = Yii::app()->request->getParam('id');
        if($action == 'update'){
            $model = $this->loadModel($id);
        }else{
            $model=new Slide;
        }
        

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Slide']))
		{
			$model->attributes=$_POST['Slide'];
            if($action == 'add'){
                $exists = Slide::model()->findByAttributes(array(
                    'image' => $model->image,
                ));
                if(!$exists) $model->save();
            }else{
                $model->save();
            }
            
            $list = Slide::model()->findAll(array(
                'order' => 'position ASC',
            ));
            if(count($list) > 0){
                $html = '';
                foreach($list as $value){
                    $class = ($value['status'] == 0) ? ' disable' : '';
                    $image = SimpleImage::model()->getThumbnail($value['image'],150);
                    $html .= '<li id="order-'.$value['id'].'"class="slide-item '.$class.'" data-id="'.$value['id'].'">
                                <i class="material-icons edit" title="Sửa">create</i>
                                <i class="material-icons delete  uk-text-danger" title="Xóa">clear</i>
                                <div class="image" style="background:#d7d7d7 url(\''.$image.'\') no-repeat center;background-size:100%"></div>
                                <p class="title">'.$value['title'].'</p>
                             </li>';
                }
                echo $html;
            }
				
		}
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

		if(isset($_POST['Slide']))
		{
			$model->attributes=$_POST['Slide'];
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
		$dataProvider=new CActiveDataProvider('Slide');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
    
    public function actionSort(){
        $order = Yii::app()->request->getPost('order');
        if(count($order) > 0){
            $i=0;
            foreach($order as $value){
                $i++;
                $sql = "UPDATE slide SET position = $i WHERE id = $value";
                Yii::app()->db->createCommand($sql)->execute();
            }
        }
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
        $model=new Slide('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Slide']))
			$model->attributes=$_GET['Slide'];
        $criteria = new CDbCriteria;
        $criteria->order = 'position ASC';
        $list = Slide::model()->findAll($criteria);
		$this->render('admin',array(
			'model'=>$model,
            'list' => $list,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Slide the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Slide::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Slide $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='slide-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
