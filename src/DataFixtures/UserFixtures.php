<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    // Rappel: Injecter dans un constructeur = est accessible dans toute la classe
    // Ca devient implicitement un membre de classe
    public function __construct(private UserPasswordHasherInterface $passwordHasher){
    }

    public function load(ObjectManager $manager): void
    {
        // USER PAR DEFAUT
        $user = new User();
        $user->setEmail("velocipastor@gmail.com");
        $user->setUsername("velocipastor");

        // générer un mot de passe
        $hashedPassword = $this->passwordHasher->hashPassword($user, "123");

        // setter le mot de passe généré
        $user->setPassword($hashedPassword);

        $manager->persist($user);

        $manager->flush();
    }
}
