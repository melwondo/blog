<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_index")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'owner' => 'Mélanie',
        ]);
    }

    /**
     * @Route("/blog/show/{page}", name="blog_show", requirements={"page"="^[a-z0-9]+(?:-[a-z0-9]+)*$"}, methods={"GET"}, defaults={"page"="/"})
     * 
     */
    public function show($page)
    {
        
        
        if ($page == "/") {
            $page = "article sans titre";
            $page = ucwords($page);
            return $this->render('blog/show.html.twig', [
                'page' => $page,
                
            ]);
        }else{
            $traitmentTiret = explode("-", $page);
            $chaine = implode(" ",$traitmentTiret );
            $page = ucwords($chaine);

            return $this->render('blog/show.html.twig', [
                'page' => $page,
                'traitmentTiret' => $traitmentTiret,
                'chaine' => $chaine
            ]);
        }
    }
}
