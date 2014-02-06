<?php
namespace Application\Service;

use Application\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class Tipo extends AbstractService{
	public function __construct(EntityManager $em){
		parent::__construct($em);
		$this->entity = "Application\Entity\ImagensHasTipo";
	}
	public function insert(array $data)
	{
		$this->setTargetEntity(array(
				array("setTargetEntity" => "Application\Entity\Imagens",
						"setCampo" => "setImagen",
						"setActionReference" => $data['idimagen']),
				array("setTargetEntity" => "Application\Entity\Tipo",
						"setCampo" => "setTipo",
						"setActionReference" => $data['idtipo']),
		));
		return parent::insert($data);
	}
}

?>