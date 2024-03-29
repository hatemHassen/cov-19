<?php


namespace App\Infrastructure\Traits;


trait SlugifyTrait
{
    function slugify($string){
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
    }
}