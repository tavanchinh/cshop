<?php

class MemberController extends Controller
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
        
        //CVarDumper::dump($rules,10,true);die;
        return $rules;
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$list_lead_ctv = Member::model()->getListByGroupID(4); // Danh sách trưởng nhóm CTV
        $list_ctv = Member::model()->getListByGroupID(5); //Danh sách cộng tác viên
        $model = Member::model()->findByPk($id);
        if(array_key_exists(Yii::app()->session['admin_id'],$list_lead_ctv) && array_key_exists($id,$list_ctv)){
            if($model->parent_id != Yii::app()->session['admin_id']){
                throw new CHttpException('403','Bạn không phải là người quản lý CTV này');
            }    
        }
        
        //Những dự án tham gia
        $list_groups = Member::model()->getListGroup($id);
        
        $sql = "SELECT * FROM project WHERE id IN (SELECT project_id FROM project_member WHERE member_id = $id)";        
        $list_project = Yii::app()->db->createCommand($sql)->queryAll();
        
        $sql = "SELECT a.*, b.id as pid,b.name as pname FROM issues a INNER JOIN project b ON a.project_id = b.id WHERE a.member_id = $id ORDER BY id DESC";
        $list_issues = Yii::app()->db->createCommand($sql)->queryAll();
        
        $sql = "SELECT a.name, a.cat_id, a.project_id, b.* FROM issues a INNER JOIN issues_action b ON a.id = b.issue_id WHERE a.member_id =$id ORDER BY b.create_date DESC LIMIT 20";
        $list_actions = Yii::app()->db->createCommand($sql)->queryAll();
        
        //CVarDumper::dump($list_groups,10,true);die;
        $this->render('view',array(
			'model'=>$this->loadModel($id),
            'list_project' => $list_project,
            'list_groups' => $list_groups,
            'list_issues' => $list_issues,
            'list_actions' => $list_actions,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Member;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Member']))
		{
			$model->attributes=$_POST['Member'];
         $model->password = md5($model->password);
         $model->repeat_password = md5($model->repeat_password);
         //Kiểm tra trùng lặp
         $check_exsist = Member::model()->findByAttributes(array(
            'user_name' => $model->user_name,
         ));
         if($check_exsist != null){
            $model->addError('user_name','Tên đăng nhập đã có người sử dụng');
         }else{
            if($model->validate()){
               
               $model->save();
               //Cập nhật vào bảng member_group
               if(isset($_POST['Member']['groups'])){
                  foreach($_POST['Member']['groups'] as $value){
                     $member_group = new MemberGroup();
                     $member_group->member_id = $model->id;
                     $member_group->group_id = $value;
                     $member_group->save();      
                  }
               }
               
               //Cập nhật vào bảng project_member
               if(isset($_POST['Member']['project'])){
                  foreach($_POST['Member']['project'] as $value){
                     $member_project = new ProjectMember();
                     $member_project->member_id = $model->id;
                     $member_project->project_id = $value;
                     $member_project->save();      
                  }
               }
               $this->redirect(array('admin'));
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
        $list_lead_ctv = Member::model()->getListByGroupID(4); // Danh sách trưởng nhóm CTV
        $list_ctv = Member::model()->getListByGroupID(5); //Danh sách cộng tác viên
        
        if(array_key_exists(Yii::app()->session['admin_id'],$list_lead_ctv) && array_key_exists($model->id,$list_ctv)){
            if($model->parent_id != Yii::app()->session['admin_id']){
                throw new CHttpException('403','Bạn không phải là người quản lý CTV này');
            }    
        }
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Member']))
		{
			
            $model->attributes=$_POST['Member'];
            $model->password = md5($model->password);
            $model->repeat_password = md5($model->repeat_password);
            if($model->validate()){
                $model->save();
                MemberGroup::model()->deleteAllByAttributes(array(
                   'member_id' => $id
                ));
            
                //Cập nhật vào bảng member_group
                if(isset($_POST['Member']['groups'])){
                   foreach($_POST['Member']['groups'] as $value){
                      $member_group = new MemberGroup();
                      $member_group->member_id = $model->id;
                      $member_group->group_id = $value;
                      $member_group->save();      
                   }
                }
            
                //Cập nhật vào bảng project_member
                ProjectMember::model()->deleteAllByAttributes(array(
                   'member_id' => $id
                ));
                if(isset($_POST['Member']['project'])){
                    foreach($_POST['Member']['project'] as $value){
                        $member_project = new ProjectMember();
                        $member_project->member_id = $model->id;
                        $member_project->project_id = $value;
                        $member_project->save();      
                    }
                }
            }
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
		MemberGroup::model()->deleteAllByAttributes(array(
         'member_id' => $id
      ));
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
		$dataProvider=new CActiveDataProvider('Member');
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
        $model=new Member('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Member']))
			$model->attributes=$_GET['Member'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Member the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Member::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Member $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='member-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
   
   
   public function actionChangepassword(){
      $id = Yii::app()->session['admin_id'];
      $model = $this->loadModel($id);
      $model->setScenario('changePwd');
      $msg = '';
      if(isset($_POST['Member'])){
         $model->attributes = $_POST['Member'];
         $valid = $model->validate();
         if($valid){
            $model->password = md5($model->new_password);
            if($model->save())
               $msg = 'Đổi mật khẩu thành công';
            else
               $msg = 'Mật khẩu chưa được thay đổi';
         }else{
            CVarDumper::dump($model->errors,10,true);die();
         }
      }
      
      $this->render('changepassword',array('model'=>$model,'msg' => $msg)); 
   }
   
   public function gridGroup($data,$row){
      //List group
      $db = Yii::app()->db;
      $sql = "SELECT name FROM groups A INNER JOIN member_group B ON A.id = B.group_id WHERE member_id = " . $data->id;
      $cmd= $db->createCommand($sql);
      $list_actor = $cmd->queryAll();
      $str_group = 'Chưa chọn';
      if(count($list_actor) > 0){
         $str_group = '';
         foreach($list_actor as $value){
            $str_group .= $value['name'].',';
         }
         $str_group = substr($str_group,0,-1);
         
      }
      return $str_group;
      
   }
   
    public function actionList(){
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);
        }
        $model=new Member('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Member']))
			$model->attributes=$_GET['Member'];
        $dataProvider = $model->search();
		$this->render('list',array(
			'model'=>$model,
            'dataProvider' => $dataProvider,
		));
    }
    
    public function gridName($data,$row){
        return '<a href="/cms/member/view/id/'.$data->id.'">'.$data->display_name.'</a>';
    }
    
    
    public function actionProfile(){
        $sql = "SELECT a.*, c.name FROM member a INNER JOIN member_group b ON a.id = b.member_id INNER JOIN groups c ON b.group_id = c.id WHERE a.id =".Yii::app()->session['admin_id'];
        
        $info = Yii::app()->db->createCommand($sql)->queryRow();
        
        $member_id = Yii::app()->session['admin_id'];
        $sql = "SELECT a.*, b.id as pid,b.name as pname FROM issues a INNER JOIN project b ON a.project_id = b.id WHERE a.member_id = $member_id ORDER BY id DESC";
        $list_issues = Yii::app()->db->createCommand($sql)->queryAll();
        //CVarDumper::dump($result,10,true);die; 
        
        $sql = "SELECT * FROM project WHERE id IN (SELECT project_id FROM project_member WHERE member_id = $member_id)";
        $list_project = Yii::app()->db->createCommand($sql)->queryAll();
        
        //Table article
        $sql = "SELECT * FROM article WHERE member_id =$member_id";
        $list_article = Yii::app()->db->createCommand($sql)->queryAll();
        $this->render('profile',array(
            'info' => $info,
            'list_issues' => $list_issues,
            'list_project' => $list_project,
            'list_article' => $list_article,
        ));
    }
    
    /**
     * Danh sách cộng tác viên
     * 
    */
    public function actionListCollaborators(){
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);
        }
        $group_id = 5;
        $model=new Member('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Member']))
			$model->attributes=$_GET['Member'];
        $dataProvider = $model->searchByGroupID($group_id);
		$this->render('list',array(
			'model'=>$model,
            'dataProvider' => $dataProvider,
            'group_id' => $group_id,
		));
    }
    
    /**
     * Danh sách nhân viên viên
     * 
    */
    public function actionListStaff(){
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);
        }
        $group_id = 6;
        $model=new Member('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Member']))
			$model->attributes=$_GET['Member'];
        $dataProvider = $model->searchByGroupID($group_id);
		$this->render('list',array(
			'model'=>$model,
            'dataProvider' => $dataProvider,
            'group_id' => $group_id,
		));
    }
    
    
    
    
    /**
     * Danh sách trưởng nhóm cộng tác viên
     * 
    */
    public function actionListLeaderCollaborators(){
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);
        }
        $group_id = 4;
        $model=new Member('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Member']))
			$model->attributes=$_GET['Member'];
        $dataProvider = $model->searchByGroupID($group_id);
		$this->render('list',array(
			'model'=>$model,
            'dataProvider' => $dataProvider,
            'group_id' => $group_id,
		));
    }
    
    /**
     * Danh sách trưởng nhóm SEO
     * 
    */
    public function actionListLeaderSeo(){
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);
        }
        $group_id = 3;
        $model=new Member('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Member']))
			$model->attributes=$_GET['Member'];
        $dataProvider = $model->searchByGroupID($group_id);
		$this->render('list',array(
			'model'=>$model,
            'dataProvider' => $dataProvider,
            'group_id' => $group_id,
		));
    }
    
    /**
     * Danh sách trợ lý
     * 
    */
    public function actionListAides(){
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);
        }
        $group_id = 2;
        $model=new Member('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Member']))
			$model->attributes=$_GET['Member'];
        $dataProvider = $model->searchByGroupID($group_id);
		$this->render('list',array(
			'model'=>$model,
            'dataProvider' => $dataProvider,
            'group_id' => $group_id,
		));
    }
    
    
    public function actionAjaxMemberGroup(){
        $group_id = Yii::app()->request->getParam('group_id');
        $list_member = Member::model()->getListByGroupID($group_id);
        if(count($list_member) > 0){
            foreach($list_member as $key=>$value){
                echo '<option value='.$key.'>'.$value.'</option>';
            }
        }
    }
   
}
