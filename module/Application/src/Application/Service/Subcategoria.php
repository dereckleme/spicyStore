<?php
namespace Application\Service;

use Application\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class Subcategoria extends AbstractService{
	public function __construct(EntityManager $em){
		parent::__construct($em);
		$this->entity = "Application\Entity\Subcategoria";
	}
	public function insert(array $data)
	{
		$this->setTargetEntity(array(
				array("setTargetEntity" => "Application\Entity\Categoria",
						"setCampo" => "setCategoriacategoria",
						"setActionReference" => $data['idCategoria']),
		));
		return parent::insert($data);
	}
}

?>