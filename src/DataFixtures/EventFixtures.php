<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EventFixtures extends AbstractFixtures implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $event = new Event();

            $event->setName($this->faker->word());

            $event->setDescription($this->faker->sentence());
            $event->setCashprize($this->faker->randomNumber(5, true));
            $event->setDateStart($this->faker->dateTimeBetween('-3 month', '+3 month'));

            $event->setDateStartInscrip($this->faker->dateTimeBetween('-3 month', '+3 month'));
            $event->setDateEndInscrip($this->faker->dateTimeBetween('-2 month', '+2 month'));
            $event->setDateEnd($this->faker->dateTimeBetween('-3 month', '+3 month'));

            $this->setReference('event_' .$i , $event);

            $event->setUser($this->getReference('user_' . $this->faker->randomNumber(1, 10)));
            $event->setRanked($this->getReference('rank_' . $this->faker->randomNumber(1, 7)));

            $manager->persist($event);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            RankFixtures::class,
        ];
    }
}
