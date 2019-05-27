<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\Article;
use App\DataFixtures\CategoryFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ArticleFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        
        
        for ($j=1; $j <= 50 ; $j++) { 
            $article = new Article();

            $article->setTitle(mb_strtolower($faker->sentence()));
            $article->setContent($faker->text($maxNbChars = 300));
            
            $manager->persist($article);
            $article->setCategory($this->getReference('categorie_'.mt_rand(0, 4)));
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}