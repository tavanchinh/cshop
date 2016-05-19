<?php

class TagController extends Controller
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
        $this->render('view', array('model' => $this->loadModel($id), ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Tag;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Tag'])) {
            $model->attributes = $_POST['Tag'];
            if ($model->save())
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

        if (isset($_POST['Tag'])) {
            $model->attributes = $_POST['Tag'];
            if ($model->save())
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
        //Xóa trong bảng news_tag trước
        NewsTag::model()->deleteAllByAttributes(array('tag_id' => $id));
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
        $dataProvider = new CActiveDataProvider('Tag');
        $this->render('index', array('dataProvider' => $dataProvider, ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize', (int)$_GET['pageSize']);
            unset($_GET['pageSize']);
        }
        $model = new Tag('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Tag']))
            $model->attributes = $_GET['Tag'];

        $this->render('admin', array('model' => $model, ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Tag the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Tag::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Tag $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tag-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }


    /**
     * Search and return json format
     */
    public function actionAutocomplete()
    {
        $keyword = '"' . trim(Yii::app()->request->getParam('term')) . '"';
        $result = array();
        //Nếu người dùng nhập keyword thì thực hiện search bằng solr
        if ($keyword != '""') {
            $result_solr = Yii::app()->tagSearch->get('tname:' . $keyword, 0, 15);

            if ($result_solr && $result_solr->response->numFound > 0) {

                foreach ($result_solr->response->docs as $value) {
                    $tmp['id'] = $value->id;
                    $tmp['label'] = $value->tname;
                    $result[] = $tmp;
                }
            }
        } else { // Chưa nhập thì lấy 15 bản ghi mới nhất
            $criteria = new CDbCriteria();
            $criteria->limit = 15;
            $criteria->order = 'id DESC';
            $list = Tag::model()->findAll($criteria);

            if (count($list) > 0) {
                foreach ($list as $value) {
                    $tmp['id'] = $value->id;
                    $tmp['label'] = $value->name;
                    $result[] = $tmp;
                }
            }
        }

        echo json_encode($result);
    }


    /**
     * Insert and return id and name
     */
    public function actionQuickAdd()
    {
        $term = Yii::app()->request->getParam('term');
        $result = array();
        if ($term != null) {
            $result['label'] = $term;
            $model = new Tag();
            $model->name = $term;
            if ($model->validate()) {
                $model->save();
                $result['id'] = $model->id;
                echo json_encode($result);
            }

        }

    }
}
