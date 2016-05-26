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
                array(
                    'class' => 'ext.sitemapgenerator.SGUrlRule',
                    'route' => '/sitemap',
                ),
            )),
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
                /*
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'trace',
					'categories'=>'system.db.*',
					'logFile'=>'sql.log',
				),
                */
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
        'facebook' => array(
            'class' => 'ext.yii-facebook-opengraph.SFacebook',
            'appId'=>'174176739397727', // needed for JS SDK, Social Plugins and PHP SDK
            'secret'=>'6c0e227e04e9c11fd61562f17340c9eb',
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
        'cache_time' => 3600,
    ));
