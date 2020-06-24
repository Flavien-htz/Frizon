<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtensions extends AbstractExtension{

        public function getFunctions()
        {
            return [
                new TwigFunction( 'image', [$this, 'formatImage'] )
            ];
        }

        public function formatImage(string $filename){

            if (strpos($filename, 'picsum')) {
                return true;
            }

        }

}