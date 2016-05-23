<?php

class ProductController extends Controller
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
		$model=new Product;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        if(isset($_POST['Product']))
        {
		      
			$model->attributes=$_POST['Product'];
            $model->create_date = date('Y-m-d H:i:s');
            $model->create_by = Yii::app()->session['admin_id'];
            
			if($model->save()){
                if(isset($_POST['categories']) && count($_POST['categories']) > 0){
                    ProductCategory::model()->QuickAdd($model->id,$_POST['categories']);
                }
                
                if(isset($_POST['product_image']) && count($_POST['product_image']) > 0){
                    ProductGallery::model()->QuickAdd($model->id,$_POST['product_image']);
                }
                
                if(isset($_POST['tags']) && count($_POST['tags']) > 0){
                    $list_tags = explode(',',$_POST['tags']);
                    ProductTag::model()->QuickAdd($model->id,$list_tags);
                }
                if(!$_POST['continue']){
                    $this->redirect(array('admin'));
                }else{
                    $model->unsetAttributes();
                }
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

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
            $model->modify_date = date('Y-m-d H:i:s');
            $model->modify_by = Yii::app()->session['admin_id'];
            if(isset($_POST['Product']['options'])){
                $model->custom_field = Product::model()->encodeOptions($_POST['Product']['options']);
            }
			if($model->save()){
                if(isset($_POST['categories']) && count($_POST['categories']) > 0){
                    ProductCategory::model()->QuickAdd($model->id,$_POST['categories'],true);
                }
                
                if(isset($_POST['product_image']) && count($_POST['product_image']) > 0){
                    ProductGallery::model()->QuickAdd($model->id,$_POST['product_image'],true);
                }
                
                if(isset($_POST['tags']) && count($_POST['tags']) > 0){
                    $list_tags = explode(',',$_POST['tags']);
                    ProductTag::model()->QuickAdd($model->id,$list_tags,true);
                }
                if(!$_POST['continue']){
                    $this->redirect(array('admin'));
                }else{
                    $model->unsetAttributes();
                }
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
        $model = $this->loadModel($id)->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
    
    /**
     * Hide product
    */
    public function actionTrash(){
        $id = Yii::app()->request->getPost('id');
        $model =  $this->loadModel($id);
        $model->status = 3;
        $model->save();
    }
    
    /**
     * Toggle feature product
    */
    public function actionToggleFeature(){
        $id = Yii::app()->request->getPost('id');
        $feature = Yii::app()->request->getPost('feature');
        $feature = (-1)*$feature+1;
        $model = $this->loadModel($id);
        $model->feature = $feature;
        $model->save();
    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Product');
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
        
        
        $model=new Product('search');
		$model->unsetAttributes();  // clear any default values
        $view_mode = Yii::app()->request->getParam('view','all');
        $list_count_by_status = Product::model()->countGroupStatus();
        
        switch($view_mode){
            case 'pending':
                $model->status = 0;
                break;
            case 'show':
                $model->status = 1;
                break;
            case 'draft':
                $model->status = 2;
                break;
            case 'hide':
                $model->status = 3;
                break;
            default:
                $model->status = null;
                break;
        }
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

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
	 * @return Product the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Product $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    
    public function gridImage($data,$row){
        return '<img src="'.SimpleImage::model()->getThumbnail($data->image,60).'" />';
    }
    public function gridTitle($data,$row){
        $url_trash  ='/admin/product/trash';
        $html = '<div class="row has-row-actions">
                    <a class="title" href="/admin/product/update/id/'.$data->id.'">'.$data->title.'</a>
                    <ul class="row-actions">
                        <li><a href="/admin/product/update/id/'.$data->id.'">Edit</a></li>';
        if($data->status != 3){
            $html .= '<li><a onclick="delete_row(this,\''.$url_trash.'\','.$data->id.')" class="trash delete" href="javascript:void(0)">Trash</a></li>';
        }    
        $html .='</ul>
                </div>';
        return $html;
        
    }
    public function gridCategories($data,$row){
        $list = Product::model()->getCatSelected($data->id);
        $str = implode(', ',$list);
        return $str;
        
    }
    public function gridStock($data,$row){
        if($data->stock){
            return '<span class="uk-badge uk-badge-success">'.Product::model()->list_stock[$data->stock].'</span>';
        }else{
            return '<span class="uk-badge uk-badge-danger">'.Product::model()->list_stock[$data->stock].'</span>';
        }
        //return '<a href="/admin/product/edit/id/'.$data->id.'">'.$data->title.'</a>';
    }
    
    public function gridDate($data,$row){
        if($data->modify_date != ''){
            $str = 'Cập nhật lúc:<br />' . date('d/m/Y H:i',strtotime($data->modify_date));
        }else{
            $str = 'Thêm lúc:<br />' . date('d/m/Y H:i',strtotime($data->create_date));
        }
        return $str;
    }
    
    public function gridFeature($data,$row){
        if($data->feature){
            $star = 'star';
            $class = 'material-icons active';
            
        }else{
            $star = 'star_border';
            $class = 'material-icons';
        }
        $funtion = "toggle_feature(this,'/admin/product/togglefeature',".$data->id.",".$data->feature.")";
        return '<i onclick="'.$funtion.'" class="'.$class.'">'.$star.'</i>';
    }
}
