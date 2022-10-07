<?php

namespace App\DataFixtures;

use App\Module\User\Factory\UserFactory;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends BaseFixture
{
    public const USER_PASSWORD = 'password';
    public const ADMIN_EMAIL = 'admin@admin.fr';
    public const USER_EMAIL = 'user@user.fr';

    public function __construct(
        private UserFactory $factory
    )
    {}

    public function load(ObjectManager $manager): void
    {
        $faker = self::getFaker();

        $manager->persist(
            $this->factory->createNew(
                self::USER_EMAIL,
                self::USER_PASSWORD,
                ['ROLE_USER']
            )
        );

        $manager->persist(
            $this->factory->createNew(
                self::ADMIN_EMAIL,
                self::USER_PASSWORD,
                ['ROLE_ADMIN']
            )
        );

        for ($i = 0; $i < 5; $i++) {
            $manager->persist(
                $this->factory->createNew(
                    $faker->email,
                    self::USER_PASSWORD,
                    ['ROLE_USER']
                )
            );
        }

        $manager->flush();
    }
}
