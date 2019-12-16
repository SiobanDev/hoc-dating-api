<?php

namespace App\DataFixtures;

use App\Entity\User;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create('fr_FR');

        $adminUser = new User();

        $adminUser->setEmail("admin@admin.com")
                   ->setLogin("admin01")
                   ->setActive(true)
                   ->setRoles(['ROLE_ADMIN'])
                   ->setBirthDate(new \DateTime('2000-01-01'))
                   ->setGender(null)
                   ->setProfilePic($faker->imageUrl(150, 150))
                   ->setPassword(
                    $this->encoder->encodePassword(
                        $adminUser,
                        'admin01'
                    )
            );;

        $manager->persist($adminUser);

        for ($i = 0; $i < 70; $i++) {
            $user = new User();

            $login = $faker->userName;

            $user->setEmail($faker->email)
            ->setLogin($login)
            ->setPassword($faker->password)
            ->setActive($faker->boolean(25))
            ->setBirthDate($faker->dateTime('now'))
            ->setPassword($this->encoder->encodePassword(
                $user,
                $login
            ))
            ->setGender($faker->title())
            ->setProfilePic($faker->imageUrl(150, 150));

            $manager->persist($user);

        }
        $manager->flush();

    }
}
