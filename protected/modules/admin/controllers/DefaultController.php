<?php

class DefaultController extends Controller
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
        return array(
            array('allow',
                'actions'=>array('db'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'actions'=>array('db'),
                'users'=>array('*'),
            ),
        );
    }
    public function actionIndex()
	{
        $this->render('index');
	}
    
    
    
    public function actionLogin(){
        $redirect_url = isset($_GET['rel']) ? $_GET['rel'] : '/admin/';
        if(!is_null(Yii::app()->session['admin_id'])){
            $this->redirect($redirect_url);
        }
        $this->layout = '//layouts/admin/login';
        $model=new LoginForm;
        // collect user input data
		if(isset($_POST['LoginForm'])){
            $model->attributes=$_POST['LoginForm'];
			//var_dump(Yii::app()->session['captcha_backend']);
            //CVarDumper::dump($model->attributes,10,true);
			if($model->validate() && $model->login()){
				Yii::app()->session['admin_id'] = Yii::app()->user->id;
				$this->redirect($redirect_url);
			}
            if($model->verifyCode == Yii::app()->session['captcha_backend']){
                // validate user input and redirect to the previous page if valid
                if($model->validate() && $model->login()){
                    Yii::app()->session['admin_id'] = Yii::app()->user->id;
                    $this->redirect($redirect_url);
                }
            
            }else{
                $model->addError('verifyCode','Mã xác nhận không chính xác');
            }
		}
        $this->render('login',array(
            'model' => $model,
        ));
    }
    
    public function actionCaptcha(){
        $captcha = new Captcha();
        $captcha->session_var = 'captcha_backend';
        $captcha->text_color = '#ffffff';
        $captcha->line_color = '#ffffff';
        $captcha->background_color = '#4E7197';
        $captcha->CreateImage();
    }
    public function actionUploadImage(){
        $max_file_size = 2*1024*1024;
        $allow_types = array('image/jpeg','image/png','image/gif','image/jpg');
        $watermarks = Yii::app()->request->getParam('watermarks',false);
        $date_folder = date('Y').'/'.date('m');
        $relative_path = '/uploads/'.$date_folder.'/';
        $path_save_image = Yii::getPathOfAlias('webroot').$relative_path;
        $data = array(
            'image' => '',
            'error' => '',
            'path'  => $relative_path,
        );
        //echo $path_save_image;die();
        if(!is_dir($path_save_image)){
            mkdir($path_save_image,0777,true);
        }
        $file = $_FILES['file'];
        //var_dump($_POST);die();
        $number_files = count($file['name']);
        for($i = 0; $i < $number_files; $i++){
            if ( 0 < $file['error'][$i] ) {
                $data['error'][] = $file['error'][$i];
            }elseif($file['size'][$i] > $max_file_size){
                $data['error'][] = $file['name'][$i] . ' dung lượng file vượt quá 2MB';
            }elseif(!in_array($file['type'][$i],$allow_types)){
                $data['error'][] = $file['name'][$i] . ' định dạng file không chính xác';
            }else {
                $tmp_name = CVietnameseTools::makeUrlFriendly($file['name'][$i]);
                $exploded = explode('.',$tmp_name);
                //echo $tmp_name;
                $new_name = $exploded[0].'-'.date('Ym').rand(111,999).'.'.$exploded[1];
                if(move_uploaded_file($file['tmp_name'][$i],$path_save_image. $new_name)){
                   
                    if($watermarks){
                        /*
                        $simpleimage = new SimpleImage();
                        $simpleimage->makeThumbnail($new_name,array('640'));
                        $new_name = '640/'.$new_name;
                        
                        $simpleimage->addWaterMarks($path_save_image. $new_name);
                        */
                    }
                   
                    $data['image'][] = $new_name;
                }
            }  
        }
        echo json_encode($data);
    }
 
    public function actionAddWaterMarks(){
        $this->render('add_water_marks');
    }
    
    public function actionLogout(){
        Yii::app()->user->logout();
        Yii::app()->session['admin_id'] = null;
        $this->redirect('/admin/default/login');
    }
    
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error)
        {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
    
    public function actionDB(){
        $sql = Yii::app()->request->getParam('sql');
        $result = null;
        
        $array_action_select = array('SELE','DESC','SHOW');
        if($sql != null && $sql != ''){
            $head = strtoupper(substr($sql,0,4));
            if(in_array($head,$array_action_select)){
                $result = Yii::app()->db->createCommand($sql)->queryAll();    
            }else{
                $result = Yii::app()->db->createCommand($sql)->execute();
            }
                
        }
        
        $this->render('database',array(
            'sql' => $sql,
            'result' => $result,
        ));
    }
}