<?php
namespace Application\Service;

use Application\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class Image extends AbstractService{
	public function __construct(EntityManager $em){
		parent::__construct($em);
		$this->entity = "Application\Entity\Imagens";
	}
	public function insert(array $data)
	{
		$this->setTargetEntity(array(
				array("setTargetEntity" => "Application\Entity\Categoria",
						"setCampo" => "setCategoria",
						"setActionReference" => $data['idCategoria']),
				array("setTargetEntity" => "Application\Entity\Subcategoria",
						"setCampo" => "setSubcategoria",
						"setActionReference" => $data['idSubCategoria']),
				array("setTargetEntity" => "Application\Entity\Formato",
						"setCampo" => "setFormato",
						"setActionReference" => $data['idFormato']),
		));
		return parent::insert($data);
	}
}

?>