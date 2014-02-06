<?php
namespace Application\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Automacao
 *
 * @ORM\Table(name="automacao")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Application\Entity\AutomacaoRepository")
 */
class Automacao
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="src", type="text", nullable=true)
     */
    private $src;
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $src
	 */
	public function getSrc() {
		return $this->src;
	}

	/**
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param string $src
	 */
	public function setSrc($src) {
		$this->src = $src;
	}


	
}
