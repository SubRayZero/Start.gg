<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends AbstractFixtures
{
    private $categories = [
        'Action',
        'Adventure',
        'Role-Playing',
        'Strategy',
        'Simulation',
        'Sports',
        'Racing',
        'First-Person Shooter',
        'Multiplayer Online Battle Arena (MOBA)',
        'Survival',
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->categories as $index => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $this->setReference('category_' . $index, $category);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
