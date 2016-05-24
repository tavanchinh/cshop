<?php

class GroupsController extends Controller
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
     * /**
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
        $this->render('view', array('model' => $this->loadModel($id), ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Groups;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Groups'])) {
            $model->attributes = $_POST['Groups'];
            if ($model->validate()) {
                $model->save();
                if(isset($_POST['functions']) && count($_POST['functions']) > 0){
                    GroupFunctional::model()->QuickAdd($model->id,$_POST['functions']);
                }
            }
            $this->redirect(array('admin'));
        }

        $this->render('create', array('model' => $model, ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Groups'])) {
            $model->attributes = $_POST['Groups'];
            if ($model->validate()) {
                $model->save();
                if(isset($_POST['functions']) && count($_POST['functions']) > 0){
                    GroupFunctional::model()->QuickAdd($model->id,$_POST['functions'],true);
                }
            }
            $this->redirect(array('admin'));
        }

        $this->render('update', array('model' => $model, ));
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
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Groups');
        $this->render('index', array('dataProvider' => $dataProvider, ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Groups('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Groups']))
            $model->attributes = $_GET['Groups'];

        $this->render('admin', array('model' => $model, ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Groups the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Groups::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Groups $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'groups-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    public function gridFunctional($data, $row)
    {
        //List functional
        $db = Yii::app()->db;
        $sql = "SELECT name FROM functional A INNER JOIN group_functional B ON A.id = B.functional_id WHERE group_id = " .
            $data->id;
        $cmd = $db->createCommand($sql);
        $list_actor = $cmd->queryAll();
        $str_group = 'Chưa chọn';
        if (count($list_actor) > 0) {
            $str_group = '';
            foreach ($list_actor as $value) {
                $str_group .= $value['name'] . ', ';
            }
            $str_group = substr($str_group, 0, -2);

        }
        return $str_group;
    }
}
