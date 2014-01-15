<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        	'upload-imagem' => array(
        				'type' => 'Zend\Mvc\Router\Http\Literal',
        				'options' => array(
        						'route'    => '/upload-imagem',
        						'defaults' => array(
        								'controller' => 'Application\Controller\Index',
        								'action'     => 'adiciona',
        						),
        				),
        				'may_terminate' => true,
        				'child_routes' => array(
        						'default' => array(
        								'type' => 'Zend\Mvc\Router\Http\Literal',
				        				'options' => array(
				        						'route'    => '/excluir',
				        						'defaults' => array(
				        								'controller' => 'Application\Controller\Index',
				        								'action'     => 'excluir',
				        						),
				        				),
        						),
        				),
        	),
        	'ajax-subcategoria' => array(
        			'type' => 'Zend\Mvc\Router\Http\Literal',
        			'options' => array(
        					'route'    => '/ajax-subcategoria',
        					'defaults' => array(
        							'controller' => 'Application\Controller\Index',
        							'action'     => 'getSubcategoria',
        					),
        			),
        	),
        	'ajax-categoria' => array(
        			'type' => 'Zend\Mvc\Router\Http\Literal',
        			'options' => array(
        					'route'    => '/ajax-categoria',
        					'defaults' => array(
        							'controller' => 'Application\Controller\Index',
        							'action'     => 'getCategoria',
        					),
        			),
        	),
        	'ajax-subcategoria-set' => array(
        			'type' => 'Zend\Mvc\Router\Http\Literal',
        			'options' => array(
        					'route'    => '/ajax-subcategoria-set',
        					'defaults' => array(
        							'controller' => 'Application\Controller\Index',
        							'action'     => 'setSubcategoria',
        					),
        			),
        	),
        	'ajax-categoria-set' => array(
        			'type' => 'Zend\Mvc\Router\Http\Literal',
        			'options' => array(
        					'route'    => '/ajax-categoria-set',
        					'defaults' => array(
        							'controller' => 'Application\Controller\Index',
        							'action'     => 'setCategoria',
        					),
        			),
        	),
        	'ajax-tag-get' => array(
        			'type' => 'Zend\Mvc\Router\Http\Literal',
        			'options' => array(
        					'route'    => '/ajax-tag-get',
        					'defaults' => array(
        							'controller' => 'Application\Controller\Index',
        							'action'     => 'getTag',
        					),
        			),
        	),
        	'ajax-tag-set' => array(
        			'type' => 'Zend\Mvc\Router\Http\Literal',
        			'options' => array(
        					'route'    => '/ajax-tag-set',
        					'defaults' => array(
        							'controller' => 'Application\Controller\Index',
        							'action'     => 'setTag',
        					),
        			),
        	),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/pesquisa',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'pesquisa',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                		'default' => array(
                				'type'    => 'Segment',
                				'options' => array(
                						'route'    => '[[/categoria[/:categoria]][/subcategoria[/:subcategoria]][/formato[/:formato]][/relacionado[/:relacionado]]]',
                						'defaults' => array(
                						),
                				),
                		),
                ),
            ),
            /*
            'teste' => array(
            		'type'    => 'Literal',
            		'options' => array(
            				'route'    => '/imoveis',
            				'defaults' => array(
            						'__NAMESPACE__' => 'Application\Controller',
            						'controller'    => 'Index',
            						'action'        => 'pesquisa',
            				),
            		),
            		'may_terminate' => true,
            		'child_routes' => array(
            				'wildcard' => array(
					            'type' => 'Wildcard',
					            'options' => array(
					                'key_value_delimiter' => '/',
					                'param_delimiter' => '/',
					            ),
					            'may_terminate' => true,
					        ),
            		),
            ),
            */
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController'            
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'doctrine' => array(
		    'eventmanager' => array(
		    		'orm_default' => array(
		    				'subscribers' => array(
		    						// pick any listeners you need
		    						'Gedmo\Tree\TreeListener',
		    						'Gedmo\Timestampable\TimestampableListener',
		    						'Gedmo\Sluggable\SluggableListener',
		    						'Gedmo\Loggable\LoggableListener',
		    						'Gedmo\Sortable\SortableListener'
		    				),
		    		),
		    ),
    		'driver' => array(
    				'application_entities' => array(
    						'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
    						'cache' => 'array',
    						'paths' => array(__DIR__ . '/../src/Application/Entity')
    				),
    
    				'orm_default' => array(
    						'drivers' => array(
    								'Application\Entity' => 'application_entities'
    						)
    				))),
);
