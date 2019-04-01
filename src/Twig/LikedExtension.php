<?php

namespace App\Twig;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class LikedExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('liked', [$this, 'likedFilter']),
        ];
    }

    protected $doctrine;
    public function __construct(RegistryInterface $doctrine){
        $this->doctrine = $doctrine;
    }


    public function likedFilter($user, $post)
    {
        $result = false;
        $like_repo = $this->doctrine->getRepository('App\Entity\Liker');
        $post_liked = $like_repo->findOneBy([
           "user" => $user,
           "post" => $post,
        ]);

        if (!empty($post_liked) && is_object($post_liked)){
            $result = true;
        }

        return $result;
    }
}