<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Cuser\Controller\Admin' => 'Cuser\Controller\AdminController',
        	'Cuser\Controller\User' => 'Cuser\Controller\UserController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'cuser' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/user',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Cuser\Controller',
                        'controller'    => 'Admin',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    /* 'user-login' => array(
                		'type' => 'literal',
                    	'options' => array(
                    		'route' => '/login',
                    		'defaults' => array(
                    			'controller'	=> 'User',
                    			'action'		=> 'login'
                    		),
                    	),
                	), */
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Cuser' => __DIR__ . '/../view',
        ),
    ),
);
