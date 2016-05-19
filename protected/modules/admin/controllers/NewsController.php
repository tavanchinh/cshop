<?php

class NewsController extends Controller
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
		$model=new News;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
            $model->create_by = Yii::app()->session['admin_id'];
            $model->create_date = date('Y-m-d H:i:s');
            $model->modify_date = date('Y-m-d H:i:s');
            $model->publish_date = date('Y-m-d H:i',strtotime(str_replace('/','-',$model->publish_date)));
            if($model->validate()){
                $model->save();
                //Cập nhật vào bảng news_category
                if(isset($_POST['News']['categories'])){
                    $list_cate = $_POST['News']['categories'];
                    if(count($list_cate) > 0 && is_array($list_cate)){
                        foreach($list_cate as $value){
                            $news_cate = new NewsCategory();
                            $news_cate->news_id = $model->id;
                            $news_cate->cat_id = $value;
                            $news_cate->save();      
                        }
                    }
                }
                
                //Cập nhật vào bảng film_tag
                 
                if(isset($_POST['News']['tags'])){
                    $str_tag = $_POST['News']['tags']; 
                    $list_tag = explode(',',$str_tag);                 
                    if(count($list_tag) > 0 && is_array($list_tag)){
                      foreach($list_tag as $value){
                         $news_tag = new NewsTag();
                         $news_tag->news_id = $model->id;
                         $news_tag->tag_id = $value;
                         $news_tag->save();      
                      }
                    }
                }
                $this->redirect(array('admin'));
            }
			
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

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
            $model->publish_date = date('d/m/Y H:i:s', strtotime($model->publish_date));
            $model->last_update_by = Yii::app()->session['admin_id'];
            $model->modify_date = date('Y-m-d H:i:s');
            $member_id = Yii::app()->session['admin_id'];
            $super_admin = MemberGroup::model()->findByAttributes(array(
                'group_id' => 1,
                'member_id' => $member_id,
                ));
            if ($super_admin == null) {
                if ($model->create_by != $member_id) {
                    Yii::app()->user->setFlash('error',
                        'Bạn không có quyền sửa bài của người khác đăng');
                }
            }
            
            NewsCategory::model()->deleteAllByAttributes(array('news_id' => $id));
            NewsTag::model()->deleteAllByAttributes(array('news_id' => $id));
            if($model->validate()){
                $model->publish_date = date('Y-m-d H:i', strtotime(str_replace('/', '-', $model->publish_date)));
                $model->save();
                //Cập nhật vào bảng news_category
                if(isset($_POST['News']['categories'])){
                    $list_cate = $_POST['News']['categories'];
                    if(count($list_cate) > 0 && is_array($list_cate)){
                        foreach($list_cate as $value){
                            $news_cate = new NewsCategory();
                            $news_cate->news_id = $model->id;
                            $news_cate->cat_id = $value;
                            $news_cate->save();      
                        }
                    }
                }
                
                //Cập nhật vào bảng film_tag
                 
                if(isset($_POST['News']['tags'])){
                    $str_tag = $_POST['News']['tags']; 
                    $list_tag = explode(',',$str_tag);                 
                    if(count($list_tag) > 0 && is_array($list_tag)){
                      foreach($list_tag as $value){
                         $news_tag = new NewsTag();
                         $news_tag->news_id = $model->id;
                         $news_tag->tag_id = $value;
                         $news_tag->save();      
                      }
                    }
                }
                $this->redirect(array('admin'));
            }
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
		$dataProvider=new CActiveDataProvider('News');
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
        $model=new News('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return News the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=News::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param News $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function gridImage($data,$row){
        $img_src = SimpleImage::model()->getThumbnail($data->avatar,'90');
        return '<img src="'.$img_src.'"/>';
    }
    
    public function gridStatus($data,$row){
        if($data->status == 0){
            $class = 'uk-badge uk-badge-warning';
            
        }elseif($data->status == 1){
            $class = 'uk-badge uk-badge-success';   
        }else{
            $class = 'uk-badge uk-badge-danger';
        }
        $img_src = SimpleImage::model()->getThumbnail($data->avatar,'90');
        return '<span class="'.$class.'">'.News::model()->list_status[$data->status].'</span>';
    }
}
