<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Application\Service\Image;
use Application\Service\Formato;
use Application\Service\Tipo;
use Application\Service\Categoria;
use Application\Service\Subcategoria;
use Application\Service\Tag;
use Application\Service\Automacao;
class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getServiceConfig() {
    	return array(
    			'factories' => array(
    					'Application\Service\Image' => function($service){
    						$image = new Image($service->get('Doctrine\ORM\EntityManager'));
    						return $image;
    					},
    					'Application\Service\Formato' => function($service){
    						$formato = new Formato($service->get('Doctrine\ORM\EntityManager'));
    						return $formato;
    					},
    					'Application\Service\Tipo' => function($service){
    						$tipo = new Tipo($service->get('Doctrine\ORM\EntityManager'));
    						return $tipo;
    					},
    					'Application\Service\Categoria' => function($service){
    						$categoria = new Categoria($service->get('Doctrine\ORM\EntityManager'));
    						return $categoria;
    					},
    					'Application\Service\Subcategoria' => function($service){
    						$Subcategoria = new Subcategoria($service->get('Doctrine\ORM\EntityManager'));
    						return $Subcategoria;
    					},
    					'Application\Service\Tag' => function($service){
    						$Tag = new Tag($service->get('Doctrine\ORM\EntityManager'));
    						return $Tag;
    					},
    					'Application\Service\Automacao' => function($service){
    						$Tag = new Automacao($service->get('Doctrine\ORM\EntityManager'));
    						return $Tag;
    					},
    			)
    	);
    }
}
