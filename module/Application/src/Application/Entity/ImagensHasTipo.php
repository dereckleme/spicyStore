<?php
namespace Application\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * ImagensHasTipo
 *
 * @ORM\Table(name="imagens_has_tipo")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Application\Entity\ImagensHasTipoRepository")
 */
class ImagensHasTipo
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
     * @var \Tipo
     *
     * @ORM\ManyToOne(targetEntity="Tipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idtipo", referencedColumnName="idtipo")
     * })
     */
    private $tipo;

    /**
     * @var \Imagens
     *
     * @ORM\ManyToOne(targetEntity="Imagens")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idimagen", referencedColumnName="idimagen")
     * })
     */
    private $imagen;
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $tipo
	 */
	public function getTipo() {
		return $this->tipo;
	}

	/**
	 * @return the $imagen
	 */
	public function getImagen() {
		return $this->imagen;
	}

	/**
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param Tipo $tipo
	 */
	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}

	/**
	 * @param Imagens $imagen
	 */
	public function setImagen($imagen) {
		$this->imagen = $imagen;
	}

	
}
