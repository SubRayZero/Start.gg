<?php

namespace App\DataFixtures;

use App\Entity\Inscription;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class InscriptionFixtures extends AbstractFixtures implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $inscription = new Inscription();

            $inscription->setMail($this->faker->email());
            $inscription->setPseudo($this->faker->userName());
            $inscription->setRanked($this->faker->randomNumber(1, true));

            $inscription->setUser($this->getReference('user_' . $this->faker->randomNumber(1, 5)));
            $inscription->setEvent($this->getReference('event_' . $this->faker->randomNumber(1, 5)));
            $inscription->setTeam($this->getReference('team_' . $this->faker->randomNumber(1, 4)));

           $this->setReference('inscription_' . $i, $inscription);

            $manager->persist($inscription);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            EventFixtures::class,
            TeamFixtures::class,
        ];
    }
}
