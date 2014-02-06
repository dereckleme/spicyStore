<?php
namespace Application\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Formato
 *
 * @ORM\Table(name="formato")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Application\Entity\FormatoRepository")
 */
class Formato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idformato", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idformato;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=true)
     */
    private $nome;
	/**
	 * @return the $idformato
	 */
	public function getIdformato() {
		return $this->idformato;
	}

	/**
	 * @return the $nome
	 */
	public function getNome() {
		return $this->nome;
	}

	/**
	 * @param number $idformato
	 */
	public function setIdformato($idformato) {
		$this->idformato = $idformato;
	}

	/**
	 * @param string $nome
	 */
	public function setNome($nome) {
		$this->nome = $nome;
	}


	
}
