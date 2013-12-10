<?php

namespace Application\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * FormatoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ImagensHasTipoRepository extends EntityRepository
{
	public function getImagens($categoria,$subcategoria,$formato,$relacionado,$texto)
	{
		//$qb = $this->createQueryBuilder("imagem");
		//$qb->select('imagem');
		$qb = $this->createQueryBuilder("r");
		$qb->select('imagem');
		$qb->innerJoin("Application\Entity\Imagens", 'imagem', 'WITH', 'imagem.idimagen = r.imagen');
		$qb->innerJoin("Application\Entity\Tipo", 't', 'WITH', 't.idtipo = r.tipo');
		$qb->andWhere("t.titulo = '".$relacionado."'");
		if($categoria)
		{
			$qb->innerJoin("Application\Entity\Categoria", 'c', 'WITH', 'imagem.categoria = c.idcategoria');
			$qb->andWhere("c.slug = '".$categoria."'");
		}
		if($subcategoria)
		{
			$qb->innerJoin("Application\Entity\Subcategoria", 's', 'WITH', 'imagem.subcategoria = s.idsubcategoria');
			$qb->andWhere("s.slug = '".$subcategoria."'");
		}
		if($formato)
		{
			$qb->innerJoin("Application\Entity\Formato", 'f', 'WITH', 'imagem.formato = f.idformato');
			$qb->andWhere("f.nome = '".$formato."'");
		}
		if($texto)
		{
			$qb->andWhere("(imagem.titulo LIKE '%$texto%' OR imagem.descricao LIKE '%$texto%')");
		}
		$query = $qb->getQuery();
		$results = $query->getResult();
		return $results;
	}
}