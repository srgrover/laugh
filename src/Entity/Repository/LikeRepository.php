<?php
namespace App\Entity\Repository;
use Doctrine\ORM\EntityRepository;

class LikeRepository extends EntityRepository
{
    public function getLikesForBlog($blogId, $approved = true)
    {
        $qb = $this->createQueryBuilder('l')
            ->select('l')
            ->where('l.post = :blog_id');
        return $qb->getQuery()
                  ->getResult();
    }
    public function getLatestComments($limit = 10)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->addOrderBy('c.id', 'DESC');
        if (false === is_null($limit))
            $qb->setMaxResults($limit);
        return $qb->getQuery()
            ->getResult();
    }
}