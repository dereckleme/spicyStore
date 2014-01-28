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
use Zend\File\Transfer\Adapter\Http AS httpUploadFile;
use Zend\Filter\File\Rename;
use Zend\Session\Container;

class AutomacaoController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    public function actionExcluirAction()
    {
    	$handle = opendir('public/automacao');
    	$service = $this->getServiceLocator()->get('Application\Service\Automacao');
    	$em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	$repo = $em->getRepository("Application\Entity\Automacao")->findAll();
    	foreach($repo AS $image)
    	{
    		$service->delete(array("id" => $image->getId()));
    	}
    	while (false !== ($file = readdir($handle))) {
    		$valid = true;
    		if ($file != "." && $file != "..") {
    			$im = new \Imagick();
    			try {
    				$im->readImage('public/automacao/'.$file);
    			}
    			catch(\Exception $e) {$valid = false;}
    			
    			if($valid)
    			{
    				
    				$im->flattenImages();
    				$dadosOriginaisImagem = $im->identifyimage();
    				
    				$im->setImageFormat('png');
    				if($dadosOriginaisImagem['geometry']['width'] <= 1024 && $dadosOriginaisImagem['geometry']['height'] <= 768)
    				{
    					$im->thumbnailImage($dadosOriginaisImagem['geometry']['width'],$dadosOriginaisImagem['geometry']['height']);
    				}
    				else
    				{
    					$im->thumbnailImage(1024,768);
    				}
    				$im->writeImage('public/automacao/'.$file."big.png");
    				$im->thumbnailImage(202,190);
    				$im->writeImage('public/automacao/'.$file.".png");
    			}
    			$service->insert(array("src" => $file));
    		}
    	}
    	return new ViewModel();
    }
    public function cadastrarAction()
    {
    	$em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	$repoCat = $em->getRepository("Application\Entity\Categoria")->findBy(array(),array("titulo" => 'asc'));
    	$repo = $em->getRepository("Application\Entity\Automacao")->findOneBy(array());
    	
    	return new ViewModel(array("imagem" => $repo,"categorias" => $repoCat));
    }
    public function imageAction()
    {	
    	if($this->getRequest()->isPost())
    	{
    		$em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    		$repoCat = $em->getRepository("Application\Entity\Categoria")->findOneBy(array("idcategoria" => $this->getRequest()->getPost("categoria")));
    		$repoSubCat = $em->getRepository("Application\Entity\Subcategoria")->findOneBy(array("idsubcategoria" => $this->getRequest()->getPost("subcategoria")));
    		if(!is_dir('./public/store/'.$repoCat->getSlug())) mkdir('./public/store/'.$repoCat->getSlug());
    		if(!is_dir('./public/store/'.$repoCat->getSlug()."/".$repoSubCat->getSlug())) mkdir('./public/store/'.$repoCat->getSlug()."/".$repoSubCat->getSlug());
    		
    		$repo = $em->getRepository("Application\Entity\Automacao")->findOneBy(array("id" => $this->getRequest()->getPost("imagemId")));
    		$tpmName = date("ymds").$repo->getSrc();
    		copy('public/automacao/'.$repo->getSrc(), 'public/store/'.$repoCat->getSlug()."/".$repoSubCat->getSlug().'/'.$tpmName);
    		$valid = true;
    		$im = new \Imagick();
    		try {
    			$im->readImage('public/store/'.$repoCat->getSlug()."/".$repoSubCat->getSlug().'/'.$tpmName);
    		}
    		catch(\Exception $e) {$valid = false;}
    		if($valid)
    		{
    			
    			$im->flattenImages();
    			$dadosOriginaisImagem = $im->identifyimage();
    		
    			$im->setImageFormat('png');
    			if($dadosOriginaisImagem['geometry']['width'] <= 1024 && $dadosOriginaisImagem['geometry']['height'] <= 768)
    			{
    				$im->thumbnailImage($dadosOriginaisImagem['geometry']['width'],$dadosOriginaisImagem['geometry']['height']);
    			}
    			else
    			{
    				$im->thumbnailImage(1024,768);
    			}
    			$im->writeImage('public/store/'.$repoCat->getSlug()."/".$repoSubCat->getSlug().'/'.$tpmName."big.png");
    			$im->thumbnailImage(202,190);
    			$im->writeImage('public/store/'.$repoCat->getSlug()."/".$repoSubCat->getSlug().'/'.$tpmName.".png");
    		
    			$repositoryFormato = $em->getRepository("Application\Entity\Formato");
    			$formato = explode("(",$dadosOriginaisImagem['format']);
    			$formato = trim($formato[0]);
    			$formatoEn = $repositoryFormato->findOneBy(array('nome' => $formato));
    			if($formatoEn)
    			{
    				$idFormato = $formatoEn->getIdformato();
    			}
    			else
    			{
    				$serviceFormato = $this->getServiceLocator()->get("Application\Service\Formato");
    				$idFormato = $serviceFormato->insert(array("nome" => $formato))->getIdformato();
    			}
    			$referencias = explode(",", $this->getRequest()->getPost("referencias"));
    		
    			$serviceImage = $this->getServiceLocator()->get("Application\Service\Image");
    			$idImagem = $serviceImage->insert(array("idCategoria" => $repoCat->getIdcategoria(),
    					"idSubCategoria" => $repoSubCat->getIdsubcategoria(),
    					"idFormato" => $idFormato,
    					"src" => $tpmName,
    					"titulo" => $this->getRequest()->getPost("titulo"),
    					"descricao" => $this->getRequest()->getPost("descricao"),
    					"width" => $dadosOriginaisImagem['geometry']['width'],
    					"height" => $dadosOriginaisImagem['geometry']['height'],
    					"peso" => null
    			))->getIdimagen();
    			$service = $this->getServiceLocator()->get('Application\Service\Automacao');
    			$service->delete(array("id" => $this->getRequest()->getPost("imagemId")));
    			$viewModel = new ViewModel();
    		}
    	}
    	$view = new ViewModel();
    	$view->setTerminal(true);
    	return $view;
    }
}
