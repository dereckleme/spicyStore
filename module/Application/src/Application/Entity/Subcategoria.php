<?php
namespace Application\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Subcategoria
 *
 * @ORM\Table(name="subcategoria")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Application\Entity\SubcategoriaRepository")
 */
class Subcategoria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idsubcategoria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsubcategoria;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=45, nullable=true)
     */
    private $titulo;

    /**
     * @var string
     * @Gedmo\Slug(fields={"titulo"}, unique=true)
     * @ORM\Column(name="slug", type="string", length=45, nullable=true)
     */
    private $slug;

    /**
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_idcategoria", referencedColumnName="idcategoria")
     * })
     */
    private $categoriacategoria;
	/**
	 * @return the $idsubcategoria
	 */
	public function getIdsubcategoria() {
		return $this->idsubcategoria;
	}

	/**
	 * @return the $titulo
	 */
	public function getTitulo() {
		return $this->titulo;
	}

	/**
	 * @return the $slug
	 */
	public function getSlug() {
		return $this->slug;
	}

	/**
	 * @return the $categoriacategoria
	 */
	public function getCategoriacategoria() {
		return $this->categoriacategoria;
	}

	/**
	 * @param number $idsubcategoria
	 */
	public function setIdsubcategoria($idsubcategoria) {
		$this->idsubcategoria = $idsubcategoria;
	}

	/**
	 * @param string $titulo
	 */
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}

	/**
	 * @param string $slug
	 */
	public function setSlug($slug) {
		$this->slug = $slug;
	}

	/**
	 * @param Categoria $categoriacategoria
	 */
	public function setCategoriacategoria($categoriacategoria) {
		$this->categoriacategoria = $categoriacategoria;
	}


	
}
