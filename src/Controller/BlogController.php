<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BlogController extends AbstractController
{
    
    /**
     *
     * @Route("/blog", name="blog_index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
            'No article found in article\'s table.'
            );
        }

        return $this->render(
                'blog/index.html.twig',
                ['articles' => $articles]
        );
    }

    /** 
     * Getting a article with a formatted page for title
     *
     * @param string $page The pageger
     *
     * @Route("/blog/{page<^[a-z0-9-]+$>}",
     *     defaults={"page" = null},
     *     name="blog_show")
     *  @return Response A response instance
     */
    public function show(string $page) : Response
    {
        if (!$page) {
                throw $this
                ->createNotFoundException('No page has been sent to find an article in article\'s table.');
            }

        $page = ucwords(preg_replace("/-/", " ",$page));

        $article = $this->getDoctrine()
                ->getRepository(Article::class)
                ->findOneBy(['title' => mb_strtolower($page)]);

        if (!$article) {
            throw $this->createNotFoundException(
            'No article with ta mère '.$page.' title, found in article\'s table.'
        );
        }

        return $this->render(
        'blog/show.html.twig',
        [
                'article' => $article,
                'page' => $page,
        ]
        );
    }

    /**
     * @Route("/blog/category/{id}", name="show_category", defaults={"category" = null})
     */
    public function showByCategory(Category $category): Response
    {

   
        $articles = $category->getArticles();
        
        return $this->render('blog/category.html.twig',
        [
            'category' => $category,
            'articles' => $articles,
        ] 
        );
    }

    // /**
    //  * @Route("/blog/category/{category}", name="show_category", defaults={"category" = null})
    //  */
    // public function showByCategory(string $category)
    // {

    //     $em = $this->getDoctrine()->getManager();
        
    //     $category = $em->getRepository(Category::class)
    //             ->findOneByName($category);
   
    //     $articles = $category->getArticles();
        
    //     return $this->render('blog/category.html.twig',
    //     [
    //         'category' => $category,
    //         'articles' => $articles]
    //     );
    // }


    // /**
    //  * @Route("blog/category/{category}", name="show_category", defaults={"category" = null})
    //  */
    // public function showByCategory(string $category)
    // {
    //     $category = $this->getDoctrine()
    //             ->getRepository(Category::class)
    //             ->findOneByName($category);
    //     $article = $this->getDoctrine()
    //             ->getRepository(Article::class)
    //             ->findByCategory($category,
    //              ['id' => 'DESC'],3);
               
        
       

    //     return $this->render('blog/category.html.twig',
    //     [
    //         'category' => $category,
    //         'articles' => $article]
    //     );
    // }


    // /**
    //  * @Route("/blog/article/{id}", name="show_article")
    //  */
    // public function showA(Category $category): Response
    // {
    //     // $em = $this->getDoctrine()->getManager();
        
    //     // $category = $em->getRepository(Category::class)
    //     //         ->findOneByName($category);
   
    //     $articles = $category->getArticles();

    //     return $this->render('blog/article.html.twig', ['category'=>$category, 'articles'=> $articles]);
    // }
}
