<?php

namespace App\DataFixtures;

use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WishFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $wish = new Wish();
        $wish->setTitle('Gagner au loto');
        $wish->setDescription("Pour acheter une belle maison");
        $wish->setAuthor('John Doe');
        $wish->setIsPublished(true);
        $wish->setDateCreated(new \DateTimeImmutable());
        $manager->persist($wish);

        $wish = new Wish();
        $wish->setTitle('Sauter en parachute');
        $wish->setDescription("Avec quelqu'un d'expérimenté");
        $wish->setAuthor('John Doe');
        $wish->setIsPublished(true);
        $wish->setDateCreated(new \DateTimeImmutable());
        $manager->persist($wish);

        $manager->flush();
    }
}
