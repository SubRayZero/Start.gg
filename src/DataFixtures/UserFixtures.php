<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends AbstractFixtures
{

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($this->faker->email());

            $password = $this->faker->password();
            $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
            $user->setPassword($hashedPassword);

            $user->setPseudo($this->faker->userName());
            $user->setFirstname($this->faker->firstName());
            $user->setName($this->faker->lastName());


            $this->setReference('user_' .$i , $user);

            $manager->persist($user);
        }
        $manager->flush();
    }
}
