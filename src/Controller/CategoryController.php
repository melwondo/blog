<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function add(Request $request,  ObjectManager $manager): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            
            $manager->persist($category);
            $manager->flush();

            return $this->redirectToRoute('blog_show');
        }


        return $this->render('category/index.html.twig', [
            'form' => $form->createView(),
            'category' => $category

        ]);
    }

    // /**
    //  * @Route("/category", name="category_add")
    //  */
    // public function add()
    // {

    // }
}
