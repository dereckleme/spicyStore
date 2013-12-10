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

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    public function pesquisaAction()
    {
    	$container = new Container('namespace');
    	if($this->getRequest()->getPost("pesquisaTexto"))
    	{
			$container->pesquisa = $this->getRequest()->getPost("pesquisaTexto");
    	}
    	else if($this->getRequest()->getPost("limparPesquisa"))
    	{
    		$container->pesquisa = null;
    	}
    	$Formato = array();
    	$RouteMatch = $this->getEvent()->getRouteMatch();
    	$em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    	if(!$this->params('relacionado'))
    	{
    		$repo = $em->getRepository("Application\Entity\Imagens")->getImagens($this->params('categoria'),$this->params('subcategoria'),$this->params('formato'),$container->pesquisa);
    	}
    	else
    	{
    		$repo = $em->getRepository("Application\Entity\ImagensHasTipo")->getImagens($this->params('categoria'),$this->params('subcategoria'),$this->params('formato'),$this->params('relacionado'),$container->pesquisa);
    	}
    	$repoCat = $em->getRepository("Application\Entity\Categoria")->findAll();
    	$tipos = $em->getRepository("Application\Entity\Tipo")->findAll();
    	foreach($repo AS $imagem)
    	{
    		$Formato[$imagem->getformato()->getNome()] = $imagem->getformato()->getNome();
    	}
    	if(!$repo) $container->pesquisa = null;
    	return new ViewModel(array("pesquisa" => $container->pesquisa,"RouteMatch" => $RouteMatch, "imagens" => $repo,"categorias" => $repoCat ,"formatos" => $Formato,"tipos" => $tipos));
    }
    public function getSubcategoriaAction()
    {
    	$idCategoria = $this->getRequest()->getPost("idCategoria");
    	$em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    	$subcategorias = $em->getRepository("Application\Entity\Subcategoria")->findBy(array("categoriacategoria" => $idCategoria));
    	$viewModel = new ViewModel(array("data" => $subcategorias));
    	$viewModel->setTerminal(true);
    	return $viewModel;
    }
    public function adicionaAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    		$repoCat = $em->getRepository("Application\Entity\Categoria")->findOneBy(array("idcategoria" => $this->getRequest()->getPost("categoria")));
    		$repoSubCat = $em->getRepository("Application\Entity\Subcategoria")->findOneBy(array("idsubcategoria" => $this->getRequest()->getPost("subcategoria")));
    		if(!is_dir('./public/store/'.$repoCat->getSlug())) mkdir('./public/store/'.$repoCat->getSlug());
    		if(!is_dir('./public/store/'.$repoCat->getSlug()."/".$repoSubCat->getSlug())) mkdir('./public/store/'.$repoCat->getSlug()."/".$repoSubCat->getSlug());
    		
    		$requestPost = new httpUploadFile();
    		$requestPost->setDestination('./public/store/'.$repoCat->getSlug()."/".$repoSubCat->getSlug());
    		foreach($requestPost->getFileInfo() as $file => $info)
    		{
    			$fname = $info['name'];
    			$filtro = $requestPost->addFilter(new Rename(array(
    							"target" => $fname,
        						"randomize" => true
        				)), null, $file);
    			
    			$requestPost->receive();
    			//conversão imagem
    			$valid = true;
    			$im = new \Imagick();
    			try {
    				$im->readImage($filtro->getFileName());
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
	    			$im->writeImage($filtro->getFileName()."big.png");
	    			$im->thumbnailImage(202,190);
	    			$im->writeImage($filtro->getFileName().".png");
	    			
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
	    						"src" => $filtro->getFileInfo()['imagem']['name'], 
	    						"titulo" => $this->getRequest()->getPost("titulo"), 
	    						"descricao" => $this->getRequest()->getPost("descricao"),
	    						"width" => $dadosOriginaisImagem['geometry']['width'],
	    						"height" => $dadosOriginaisImagem['geometry']['height'],
	    						"peso" => $filtro->getFileSize()
	    				))->getIdimagen();
	    				if($this->getRequest()->getPost("referencias") != "")
	    				{
	    					$serviceTipo = $this->getServiceLocator()->get("Application\Service\Tipo");
	    					foreach($referencias AS $ref)
	    					{
	    						$serviceTipo->insert(array("idtipo" => $ref, "idimagen" => $idImagem));
	    					}
	    				}
	    			$viewModel = new ViewModel();
    			}
    			else {
    				unlink($filtro->getFileName());
    				$viewModel = new ViewModel(array("action" => 'imagem inválida'));
    			}
    		}
    	}
        $viewModel->setTerminal(true);
        return $viewModel;
    }
}
