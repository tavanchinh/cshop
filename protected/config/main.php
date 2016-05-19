<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'timeZone' => 'Asia/Ho_Chi_Minh',
    'basePath' => dirname(__file__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Tin tức điện ảnh, Diễn viên',

    // preloading 'log' component
    'preload' => array('log'),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.solr.*',
        'application.extensions.yii-mail.*',
    ),

    'modules' => array(

        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'chinhdaica',

            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1')),
        'admin',
        'cms',

    ),
    'controllerMap' => array(
        'sitemap'=>array(
            'class'=>'ext.sitemapgenerator.SGController',
            'cache'=>array('cache',0,null),
            'config'=>array(
                'sitemap.xml'=>array(
                    'index'=>false,
                    'aliases'=>'application.modules.api.controllers'
                ),
                // All keys must begin with 'sitemap'
                'sitemapActor.xml'=>array(
                    'aliases'=>array(
                        'application.modules.actor.controllers',
                    ),
                ),
            ),
        ),
    ),

    // application components
    'components' => array(
        'user' => array( // enable cookie-based authentication
            'allowAutoLogin' => true),

        // uncomment the following to enable URLs in path-format

        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '/captcha' => '/site/getcaptcha',
                '/dong-gop-y-kien.html' => '/site/contact',
                '/get-link-download-epi' => '/film/AjaxLinkEpisode',
                '/the-loai' => '/film/filter',
                '/quoc-gia' => '/film/filter',
                '/phim-xem-nhieu' => '/film/filter',
                '/phim-chieu-rap' => '/film/filter',
                '/the-loai/<title:.*?>-<cat_id:\d+>.html' => '/film/filter',
                '/quoc-gia/<title:.*?>-<city_id:\d+>.html' => '/film/filter',
                '/danh-sach/<title:.+?>-<city_id:\d+>.html' => '/film/filter',
                '/danh-sach/<title:.+?>-<year:\d+>' => '/film/filter',
                '/danh-sach/<title:.+?>.html' => '/film/filter',
                '/dien-vien/<title:.+?>-<actor_id:\d+>.html' => '/film/filter',
                '/dao-dien/<title:.+?>-<director_id:\d+>.html' => '/film/filter',
                '/tag/<title:.+?>-<tag_id:\d+>.html' => '/film/filter',
                '/phim-anime' => '/film/anime',
                '/tim-kiem.html' => '/site/search',
                '/<title:.*?>-<id:\d+>.html' => '/film/detail',
                '/xem-trailer/phim-<title:.*?>-<id:\d+>' => '/film/playtrailer',
                '/xem-phim/phim-<title:.*?>-<id:\d+>' => '/film/play',
                '/tai-phim/phim-<title:.*?>-<id:\d+>' => '/film/getlistepisodedownload',
                '/link-film/download-phim-<title:.*?>-<id:\d+>_HD<server:\d+>.html' => '/film/GetLinkDownloadEpisode',
                '/xem-phim/<title:.*?>-<id:\d+>_HD<server:\d+>.html' => '/film/play',
                '/xem-phim/<title:.*?>-<id:\d+>_e<episode_id:\d+>.html' => '/film/play',
                '/xem-phim/<title:.*?>-<id:\d+>_e<episode_id:\d+>_HD<server:\d+>.html' => '/film/play',
                '/trailer/<title:.*?>-<id:\d+>' => '/film/play',
                '/tim-kiem.html' => '/film/search',
                '/suggest' => '/film/suggest',
                '/profile' => '/user/info',
                '/film/report/<id:\d+>' => '/film/report',
                '/film/rate/<id:\d+>' => '/film/rate',
                '/lien-he-quang-cao.html' => '/site/contactads',
                '/hop-tac-noi-dung.html' => '/site/cooperatecontent',
                '/ban-quyen-noi-dung.html' => '/site/copyrightcontent',
                '/dieu-khoan-chung.html' => '/site/generalrule',
                '/unsubscribe' => '/user/unsubscribe',
                '/nhac-phim-ost.html' => '/ost/index',
                '/nhac-phim-ost/phim-<title:.*?>-<id:\d+>' => '/ost/play',
                '/nhac-phim-ost/phim-<title:.*?>-<id:\d+>_o<ost_id:\d+>.html' => '/ost/play',
                array(
                    'class' => 'ext.sitemapgenerator.SGUrlRule',
                    'route' => '/sitemap',
                ),
            )),

        /*
        * 'db'=>array(
        * 'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        * ),
        */
        // uncomment the following to use a MySQL database
        'db' => require (dirname(__file__) . '/database.php'),
        'errorHandler' => array( // use 'site/error' action to display errors
            'errorAction' => 'site/error'
        ),
        
        'log' => array (
			'class' => 'CLogRouter',
			'routes' => array (
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
					'categories' => 'exception.CHttpException.404',
					'logFile' => 'error_404.log',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
                    'logFile' => 'error.log',
					'filter'=>array(
						'class'=>'LogFilter',
						'ignoreCategories'=>array(
                            //'exception.CHttpException.404',
						),
                        
					),
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'trace',
					'categories'=>'system.db.*',
					'logFile'=>'sql.log',
				),
                /*
				array(
				   'class'=>'CPhpMailerLogRoute',
				   'levels'=>'error',
				   'filter'=>array(
						'class'=>'LogFilter',
						'ignoreCategories'=>array(
							'exception.CHttpException.404',
						)
					),
                    
				   'subject' => 'Alert error on bilutv.com',
				   'emails'=>'chinh.tv91@gmail.com'
				),
				*/
				
			) 
		),
        
        'cache' => array(
            'class' => 'system.caching.CFileCache',
            
        ),
        
        'mail' => array(
            'class' => 'ext.yii-mail.YiiMail',
            'transportType'=>'smtp',
            'transportOptions'=>array(
                'host'=>'smtp.gmail.com',
                'username'=>'thongbao.bilutv@gmail.com',
                'password'=>'07082014@@',
                'port'=>'465',
                'encryption'=>'tls',
            ),
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false,
        ),
        'filmSearch' => array(
            'class' => 'CSolrComponent',
            'host' => 'localhost',
            'port' => 8983,
            'indexPath' => '/solr/film'),
        'actorSearch' => array(

            'class' => 'CSolrComponent',
            'host' => 'localhost',
            'port' => 8983,
            'indexPath' => '/solr/actor'),
        'directorSearch' => array(

            'class' => 'CSolrComponent',
            'host' => 'localhost',
            'port' => 8983,
            'indexPath' => '/solr/director'),
        'tagSearch' => array(

            'class' => 'CSolrComponent',
            'host' => 'localhost',
            'port' => 8983,
            'indexPath' => '/solr/tag'),
        'filmBackendSearch' => array(
            'class' => 'CSolrComponent',
            'host' => 'localhost',
            'port' => 8983,
            'indexPath' => '/solr/film_backend'),
    ), // uncomment the following to show log messages on web pages
    'params' => array(
        'defaultPageSize' => 10,
        'pageSizes' => array(
            10 => 10,
            20 => 20,
            30 => 30,
            50 => 50,
            100 => 100,
            200 => 200,
            500 => 500,
        ),
        'app_id' => '1610462675881931',
        'app_secret' => 'f2e911dce6d2751597d0e063d0287721',
        'cron_key' => 'pfutccy06qh0e5yhopbm3agd6cvxfuw'
    ));
