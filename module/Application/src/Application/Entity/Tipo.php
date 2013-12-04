<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipo
 *
 * @ORM\Table(name="tipo")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Application\Entity\TipoRepository")
 */
class Tipo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtipo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtipo;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=45, nullable=true)
     */
    private $titulo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Imagens", mappedBy="idtipo")
     */
    private $idimagen;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idimagen = new \Doctrine\Common\Collections\ArrayCollection();
    }
	/**
	 * @return the $idtipo
	 */
	public function getIdtipo() {
		return $this->idtipo;
	}

	/**
	 * @return the $titulo
	 */
	public function getTitulo() {
		return $this->titulo;
	}

	/**
	 * @return the $idimagen
	 */
	public function getIdimagen() {
		return $this->idimagen;
	}

	/**
	 * @param number $idtipo
	 */
	public function setIdtipo($idtipo) {
		$this->idtipo = $idtipo;
	}

	/**
	 * @param string $titulo
	 */
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}

	/**
	 * @param \Doctrine\Common\Collections\Collection $idimagen
	 */
	public function setIdimagen($idimagen) {
		$this->idimagen = $idimagen;
	}

    
}
