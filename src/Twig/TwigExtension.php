<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TwigExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('read_more', [$this, 'shortText']),
        ];
    }

    public function shortText($text)
    {
        if(strlen($text) > 500){
            $respuesta = substr($text, 0, 490);
            $respuesta = wordwrap($respuesta);
            $respuesta .= '...';
        }else{
            $respuesta = $text;
        }

        return $respuesta;
    }
}