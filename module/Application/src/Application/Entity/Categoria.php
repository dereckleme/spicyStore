<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Application\Entity\CategoriaRepository")
 */
class Categoria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcategoria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategoria;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=45, nullable=true)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=45, nullable=true)
     */
    private $slug;
	/**
	 * @return the $idcategoria
	 */
    
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Subcategoria", mappedBy="categoriacategoria")
     */
    private $subCategorias;
    
    /**
     * Constructor
     */
    public function __construct()
    {
    	$this->subCategorias = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
    
    /**
     * @return the $subCategorias
     */
    
	/**
	 * @return the $subCategorias
	 */
	public function getSubCategorias() {
		return $this->subCategorias;
	}

	/**
	 * @param \Doctrine\Common\Collections\Collection $subCategorias
	 */
	public function setSubCategorias($subCategorias) {
		$this->subCategorias = $subCategorias;
	}

	public function getIdcategoria() {
		return $this->idcategoria;
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
	 * @param number $idcategoria
	 */
	public function setIdcategoria($idcategoria) {
		$this->idcategoria = $idcategoria;
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



}
