<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    public function pesquisaAction()
    {
    	$RouteMatch = $this->getEvent()->getRouteMatch();
    	print_r($RouteMatch);
    	die();
    	$em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    	$repo = $em->getRepository("Application\Entity\Imagens")->findAll();
    	$repoCat = $em->getRepository("Application\Entity\Categoria")->findAll();
    	$repoFormat  = $em->getRepository("Application\Entity\Formato")->findAll();
    	
    	
    	return new ViewModel(array("RouteMatch" => $RouteMatch, "imagens" => $repo,"categorias" => $repoCat ,"formatos" => $repoFormat));
    }
}
