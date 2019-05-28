<?php

namespace App\Service;

class Slugify
{
    public function generate(string $input) // faux
    {

    setlocale(LC_ALL, 'en_US.UTF-8');
    $slug = iconv('UTF-8','ASCII//TRANSLIT',$input);
    $slug = preg_replace('/\'/', '', $slug);
    $slug = preg_replace('/([!@:,?.])/', '', $slug);
    $slug = str_replace(' ', '-', $slug);
    $slug = str_replace(',', '-', $slug);
    $slug = trim($slug);
    return $slug;
        
    }
}


