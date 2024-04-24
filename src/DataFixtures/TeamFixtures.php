<?php

namespace App\DataFixtures;

use App\Entity\Team;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends AbstractFixtures
{

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $team = new Team();
            
            $team->setName($this->faker->userName());

            $this->setReference('team_' .$i , $team);

            $manager->persist($team);
        }
        $manager->flush();
    }
}
