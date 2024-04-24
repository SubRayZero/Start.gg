<?php

namespace App\DataFixtures;

use App\Entity\Inscription;
use App\Entity\Rank;
use App\Entity\Team;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RankFixtures extends AbstractFixtures implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $rank = new Rank();
            
            $rank->setNumber($this->faker->randomNumber(2, true));


            $this->setReference('rank_' .$i , $rank);

            $rank->setTeam($this->getReference('team_' .$this->faker->randomNumber(0, 6)));
            //$rank->setInscription($this->getReference('inscription_' . $this->faker->numberBetween(21, 26)));

            $manager->persist($rank);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TeamFixtures::class,
            //InscriptionFixtures::class,
        ];
    }
}
