<?php
namespace Application\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Imagens
 *
 * @ORM\Table(name="imagens")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Application\Entity\ImagensRepository")
 */
class Imagens
{
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
     * @ORM\Column(name="titulo", type="string", length=45, nullable=true)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=45, nullable=true)
     */
    private $descricao;

    /**
     * @var string
     *
     * @ORM\Column(name="src", type="string", length=45, nullable=true)
     */
    private $src;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tipo", inversedBy="idimagen")
     * @ORM\JoinTable(name="imagens_has_tipo",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idimagen", referencedColumnName="idimagen")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idtipo", referencedColumnName="idtipo")
     *   }
     * )
     */
    private $idtipo;

    /**
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idcategoria", referencedColumnName="idcategoria")
     * })
     */
    private $idcategoria;

    /**
     * @var \Formato
     *
     * @ORM\ManyToOne(targetEntity="Formato")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idformato", referencedColumnName="idformato")
     * })
     */
    private $idformato;

    /**
     * @var \Subcategoria
     *
     * @ORM\ManyToOne(targetEntity="Subcategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idsubcategoria", referencedColumnName="idsubcategoria")
     * })
     */
    private $idsubcategoria;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idtipo = new \Doctrine\Common\Collections\ArrayCollection();
    }
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
	 * @return the $idtipo
	 */
	public function getIdtipo() {
		return $this->idtipo;
	}

	/**
	 * @return the $idcategoria
	 */
	public function getIdcategoria() {
		return $this->idcategoria;
	}

	/**
	 * @return the $idformato
	 */
	public function getIdformato() {
		return $this->idformato;
	}

	/**
	 * @return the $idsubcategoria
	 */
	public function getIdsubcategoria() {
		return $this->idsubcategoria;
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
	 * @param \Doctrine\Common\Collections\Collection $idtipo
	 */
	public function setIdtipo($idtipo) {
		$this->idtipo = $idtipo;
	}

	/**
	 * @param Categoria $idcategoria
	 */
	public function setIdcategoria($idcategoria) {
		$this->idcategoria = $idcategoria;
	}

	/**
	 * @param Formato $idformato
	 */
	public function setIdformato($idformato) {
		$this->idformato = $idformato;
	}

	/**
	 * @param Subcategoria $idsubcategoria
	 */
	public function setIdsubcategoria($idsubcategoria) {
		$this->idsubcategoria = $idsubcategoria;
	}

    
}
