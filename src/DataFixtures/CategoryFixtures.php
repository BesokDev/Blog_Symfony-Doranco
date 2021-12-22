<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

/*
    Les Fixtures sont un jeu de données.
    Elles servent à remplir la BDD juste après la création de la BDD,
        pour pouvoir manipuler des données dans mon code => des entités
 */

class CategoryFixtures extends Fixture
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    
    public function load(ObjectManager $manager): void
    {
        $categories = [
            'Politique',
            'Société',
            'Économie',
            'Santé',
            'Environnement',
            'Sport',
            'Culture'
        ];

    foreach($categories as $category) {

        $cat = new Category();

        $cat->setName($category);
        $cat->setAlias($this->slugger->slug($category));

        $manager->persist($cat);
    }

        $manager->flush();
    }
}
