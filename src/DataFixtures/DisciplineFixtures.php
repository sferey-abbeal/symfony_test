<?php

namespace App\DataFixtures;

use App\Entity\Discipline;
use Doctrine\Common\Persistence\ObjectManager;

class DisciplineFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Discipline::class, 5, function (Discipline $discipline, $count) {
            $discipline->setName($this->faker->word);
        });

        $manager->flush();
    }
}
