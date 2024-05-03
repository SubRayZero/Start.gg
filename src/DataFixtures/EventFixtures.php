<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Event;
use App\Entity\Rank;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Container\ContainerInterface;
use Faker\Core\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class EventFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $categories = $manager->getRepository(Category::class)->findAll();

        for ($i = 0; $i < 10; $i++) {
            $event = new Event();

            $event->setName($this->faker->word());

            $event->setDescription($this->faker->sentence());
            $event->setCashprize($this->faker->randomNumber(5, true));
            $event->setDateStart($this->faker->dateTimeBetween('-3 month', '+3 month'));

            $event->setDateStartInscrip($this->faker->dateTimeBetween('-3 month', '+3 month'));
            $event->setDateEndInscrip($this->faker->dateTimeBetween('-2 month', '+2 month'));
            $event->setDateEnd($this->faker->dateTimeBetween('-3 month', '+3 month'));


    
            $imageFilename = 'essai.jpeg';
           
            $imagePath = 'public/images/event/' . $imageFilename;
            $this->faker->image('public/images/event', false);

            $imageFile = new UploadedFile($imagePath, $imageFilename);

            $event->setImageFile($imageFile);

            $this->setReference('event_' . $i, $event);

            $event->setUser($this->getReference('user_' . $this->faker->randomNumber(1, 10)));
            $manager->persist($event);

            $randCategories = mt_rand(1, 3);
            $selecCategories = $this->faker->randomElements($categories, $randCategories);
            foreach ($selecCategories as $category) {
                $event->addCategory($category);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
