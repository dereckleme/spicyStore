<?php
namespace Application\Service;

use Application\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class Tag extends AbstractService{
	public function __construct(EntityManager $em){
		parent::__construct($em);
		$this->entity = "Application\Entity\Tipo";
	}
}

?>