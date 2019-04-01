<?php
namespace App\Entity\Repository;
use Doctrine\ORM\EntityRepository;

class LikeRepository extends EntityRepository
{
    public function getLikesForBlog($blogId)
    {
        $qb = $this->createQueryBuilder('l')
            ->select('l')
            ->where('l.post = :blog_id')
            ->setParameter('blog_id', $blogId)
            ->getQuery()
            ->getResult();

        return count($qb);
    }
}