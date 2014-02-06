<?php
namespace Application\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * EntityImagens
 *
 * @ORM\Table(name="imagens")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Application\Entity\ImagensRepository")
 */
class Imagens
{
	public function __construct()
	{
		$this->tipos = new \Doctrine\Common\Collections\ArrayCollection();
	}
    /**
     * @var integer
     *
     * @ORM\Column(name="idimagen", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idimagen;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="text", nullable=true)
     */
    private $titulo;

     /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text", nullable=true)
     */
    private $descricao;

    /**
     * @var string
     *
     * @ORM\Column(name="src", type="text", nullable=true)
     */
    private $src;

    /**
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idcategoria", referencedColumnName="idcategoria")
     * })
     */
    private $categoria;
    /**
     * @var string
     *
     * @ORM\Column(name="peso", type="string", length=45, nullable=true)
     */
    private $peso;
    /**
     * @var \Formato
     *
     * @ORM\ManyToOne(targetEntity="Formato")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idformato", referencedColumnName="idformato")
     * })
     */
    private $formato;

    /**
     * @var \Subcategoria
     *
     * @ORM\ManyToOne(targetEntity="Subcategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idsubcategoria", referencedColumnName="idsubcategoria")
     * })
     */
    private $subcategoria;
    
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ImagensHasTipo", mappedBy="imagen")
     */
    private $tipos;
    /**
     * @var integer
     *
     * @ORM\Column(name="width", type="integer", nullable=true)
     */
    private $width;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="height", type="integer", nullable=true)
     */
    private $height;
	/**
	 * @return the $idimagen
	 */
	public function getIdimagen() {
		return $this->idimagen;
	}

	/**
	 * @return the $titulo
	 */
	public function getTitulo() {
		return $this->titulo;
	}

	/**
	 * @return the $descricao
	 */
	public function getDescricao() {
		return $this->descricao;
	}

	/**
	 * @return the $src
	 */
	public function getSrc() {
		return $this->src;
	}

	/**
	 * @return the $categoria
	 */
	public function getCategoria() {
		return $this->categoria;
	}

	/**
	 * @return the $formato
	 */
	public function getFormato() {
		return $this->formato;
	}

	/**
	 * @return the $subcategoria
	 */
	public function getSubcategoria() {
		return $this->subcategoria;
	}

	/**
	 * @return the $tipos
	 */
	public function getTipos() {
		return $this->tipos;
	}

	/**
	 * @param number $idimagen
	 */
	public function setIdimagen($idimagen) {
		$this->idimagen = $idimagen;
	}

	/**
	 * @param string $titulo
	 */
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}

	/**
	 * @param string $descricao
	 */
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}

	/**
	 * @param string $src
	 */
	public function setSrc($src) {
		$this->src = $src;
	}

	/**
	 * @param Categoria $categoria
	 */
	public function setCategoria($categoria) {
		$this->categoria = $categoria;
	}

	/**
	 * @param Formato $formato
	 */
	public function setFormato($formato) {
		$this->formato = $formato;
	}

	/**
	 * @param Subcategoria $subcategoria
	 */
	public function setSubcategoria($subcategoria) {
		$this->subcategoria = $subcategoria;
	}

	/**
	 * @param \Doctrine\Common\Collections\Collection $tipos
	 */
	public function setTipos($tipos) {
		$this->tipos = $tipos;
	}
	/**
	 * @return the $width
	 */
	public function getWidth() {
		return $this->width;
	}

	/**
	 * @return the $height
	 */
	public function getHeight() {
		return $this->height;
	}

	/**
	 * @param number $width
	 */
	public function setWidth($width) {
		$this->width = $width;
	}

	/**
	 * @param number $height
	 */
	public function setHeight($height) {
		$this->height = $height;
	}
	/**
	 * @return the $peso
	 */
	public function getPeso() {
		return $this->peso;
	}

	/**
	 * @param string $peso
	 */
	public function setPeso($peso) {
		$this->peso = $peso;
	}


	
	
	
}
