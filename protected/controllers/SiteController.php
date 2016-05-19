<?php

class SiteController extends Controller
{
    public function actionIndex()
    {
        $web_config = WebConfig::model()->getInfo();
        Yii::app()->clientScript->registerMetaTag(Yii::app()->params['app_id'], null, null,
            array('property' => 'fb:app_id'));
        Yii::app()->clientScript->registerMetaTag('website', null, null, array('property' =>
                'og:type'));
        Yii::app()->clientScript->registerMetaTag(Yii::app()->request->hostInfo, null, null,
            array('property' => 'og:url'));
        Yii::app()->clientScript->registerMetaTag($web_config->web_title, null, null,
            array('property' => 'og:title'));
        Yii::app()->clientScript->registerMetaTag($web_config->meta_description, null, null,
            array('property' => 'og:description'));
        Yii::app()->clientScript->registerMetaTag($web_config->meta_description,
            'description');
        Yii::app()->clientScript->registerMetaTag($web_config->meta_keyword, 'keywords');


        $this->pageTitle = $web_config->web_title;
        //CVarDumper::dump($list_film_hoat_hinh,10,true);die;
        $this->render('index', array());
    }


    /**
     * Tim kiem
     */
    public function actionSearch($p)
    {
        $web_config = WebConfig::model()->findByPk(1);
        $limit = $web_config->page_size_home;
        $list_post = Product::model()->getListByKeyword($p);

        $records = count($list_post);

        $pagination = new Zebra_Pagination();
        $pagination->records($records);
        $pagination->records_per_page($limit);
        $pagination->selectable_pages(5);
        $pagination->labels('Trước', 'Sau');

        $this->render('index', array(
            'list_post' => $list_post,
            'pagination' => $pagination,
            ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }


    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        setcookie('logged', null, -1, '/');
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Upload multil image width ajax
     */
    public function actionUpload()
    {
        $failed = false;
        $images = array();
        $date_folder = date('Y') . '/' . date('m') . '/';
        $upload_dir = $_SERVER["DOCUMENT_ROOT"] . '/uploads/' . $date_folder;
        $path_image = 'http://' . $_SERVER["HTTP_HOST"] . '/uploads/' . $date_folder;
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if ($_SERVER['CONTENT_LENGTH'] < 8380000) {
            if (isset($_FILES['upload_files']) && $_FILES['upload_files']['error'] != 0) {

                foreach ($_FILES['upload_files']['tmp_name'] as $key => $value) {

                    $file = $_FILES['upload_files']['name'][$key];
                    $file = CVietnameseTools::makeUrlFriendly($file);
                    // allow only image upload
                    if (preg_match('#image#', $_FILES['upload_files']['type'][$key])) {
                        if (!move_uploaded_file($value, $upload_dir . $file)) {
                            $failed = true;
                        } else {
                            $images[] = $path_image . $file;
                        }
                    } else {
                        $images = array("error" => "Sorry, only images are allowed to upload");
                    }
                }
            }
        } else {
            $images = array("error" =>
                    "Sorry, Upload size exceed allowed upload size of 8MB");
        }
        if ($failed == true) {
            $images = array("error" => "Server Error<br/>Reported to Admin");
        }
        echo '<script type="text/javascript">window.parent.Uploader.done(\'' .
            json_encode($images) . '\') </script>';

    }

    /**
     * Register user
     */
    public function actionRegister()
    {
        $model = new User();
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->password = md5($model->password);
            $model->repeatPassword = md5($model->repeatPassword);
            if ($model->validate()) {

                if ($model->save()) {
                    echo json_encode(array('success' => 'Đăng ký thành công !'));
                } else {
                    echo json_encode(array('message' => 'Có lỗi xảy ra'));
                }

            } else {
                echo json_encode(array('error' => $model->errors));
            }
        }
    }

    /**
     * Login via ajax
     */
    public function actionLogin()
    {
        if (isset($_POST['User'])) {
            $email = $_POST['User']['email'];
            $password = md5($_POST['User']['password']);
            $model = User::model()->findByAttributes(array(
                'email' => $email,
                'password' => $password,
                ));
            if (is_null($model)) {
                echo json_encode(array('error' => 'Email hoặc mật khẩu không chính xác'));
            } else {
                Yii::app()->session['user_id'] = $model->id;
                setcookie('logged', json_encode(array(
                    'id' => $model->id,
                    'email' => $email,
                    'password' => $password)), time() + 86400 * 7, '/');
                echo json_encode(array('message' => 'Đăng nhập thành công'));
            }
        }
    }

    public function actionContactAds()
    {
        $model = WebConfig::model()->findByPk(1);
        $content = $model->contact_ads;
        $this->render('static', array(
            'content' => $content,
            'title' => 'Liên hệ quảng cáo',
            ));
    }

    public function actionCooperateContent()
    {
        $model = WebConfig::model()->findByPk(1);
        $content = $model->cooperate_content;
        $this->render('static', array(
            'content' => $content,
            'title' => 'Hợp tác nội dung',
            ));
    }

    public function actionCopyrightContent()
    {
        $model = WebConfig::model()->findByPk(1);
        $content = $model->copyright_content;
        $this->render('static', array(
            'content' => $content,
            'title' => 'Bản quyền và trách nhiệm nội dung',
            ));
    }

    public function actionGeneralRule()
    {
        $model = WebConfig::model()->findByPk(1);
        $content = $model->general_rule;
        $this->render('static', array(
            'content' => $content,
            'title' => 'Điều khoản chung',
            ));
    }

    /**
     * Create captcha
     */
    public function actiongetCaptcha()
    {
        $captcha = new Captcha();
        $captcha->text_color = '#fff601';
        $captcha->line_color = '#fff601';
        $captcha->background_color = '#383838';
        $captcha->CreateImage();
    }

    /**
     * Create captcha
     */
    public function actionCaptchacontact()
    {
        $captcha = new Captcha();
        $captcha->session_var = 'captcha_contact';
        $captcha->text_color = '#fff601';
        $captcha->line_color = '#fff601';
        $captcha->background_color = '#383838';
        $captcha->CreateImage();
    }

    /**
     * Create captcha
     */
    public function actionCaptchaSubscribe()
    {
        $captcha = new Captcha();
        $captcha->session_var = 'captcha_subscribe';
        $captcha->text_color = '#fff601';
        $captcha->line_color = '#fff601';
        $captcha->background_color = '#383838';
        $captcha->CreateImage();
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model = new Feedback();

        if (isset($_POST['Feedback'])) {
            if ($_POST['Feedback']['verifyCode'] == Yii::app()->session['captcha_contact']) {
                $model->attributes = $_POST['Feedback'];
                //$model->content = Encoding::toUTF8($model->content);
                $model->status = 0;
                if ($model->validate()) {
                    $model->save();
                    Yii::app()->user->setFlash('success',
                        'Cảm ơn bạn đã liên hệ với chúng tôi. Chúng tôi sẽ trả lời bạn sớm.');
                    $model->unsetAttributes();
                }
            } else {
                $model->addError('verifyCode', 'Mã xác nhận không chính xác');
            }

        }
        $this->render('contact', array('model' => $model));
    }
    public function actionRss()
    {
        Yii::import('ext.feed.*');

        // specify feed type
        $feed = new EFeed(EFeed::RSS1);
        $feed->title = 'PhimBatHu.com Feed';
        $feed->link = 'http://phimbathu.com/';
        $feed->description =
            'Cập nhật liên tục những bộ phim mới nhất, hot nhất được công chiếu trên toàn thế giới';
        $feed->RSS1ChannelAbout = 'http://phimbathu.com/about';
        $films = Film::model()->getLastestPublished(15);
        if (count($films)) {
            foreach ($films as $film) {
                $item = $feed->createNewItem();
                $item->title = $film->name;
                $item->link = Yii::app()->createAbsoluteUrl(Film::model()->getDetailLink($film->
                    id, $film->name));
                $item->date = $film->publish_date;
                $description = str_replace('Nội dung phim', '', Str::cutString(Str::removeHTML($film->
                    content), 250));
                $description = html_entity_decode($description);
                $item->description = $description;
                $item->addTag('dc:subject', $film->name);

                $feed->addItem($item);
            }
        }

        $feed->generateFeed();
    }
    public function actionSendSubcribeMail()
    {
        if (!isset($_GET['key']) || ($_GET['key'] != Yii::app()->params['cron_key']))
            return;
        $filmSubcribes = FilmSubcribe::model()->getNotSendSubcribe();
        if (count($filmSubcribes) > 0) {
            foreach ($filmSubcribes as $filmSubcribe) {
                $film = Film::model()->findByPk($filmSubcribe->film_id);
                if ($film != null && $film->status == 1) {
                    CPhpFilmSubcribeMailer::sendSubcribeEmail($film, $filmSubcribe);
                }
            }
        }
        echo "Done";
        Yii::app()->end();
    }
    public function actionSendNewFilmMail()
    {
        if (!isset($_GET['key']) || ($_GET['key'] != Yii::app()->params['cron_key']))
            return;
        $filmSendmails = FilmSendmail::model()->getNotSendFilm();
        if (count($filmSendmails) > 0) {
            $filmSendmail = $filmSendmails[0];
            CPhpFilmSubcribeMailer::sendNewFilmEmail($filmSendmail);
        }
        echo "Done";
        Yii::app()->end();
    }
}
