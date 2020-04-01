<?php

namespace App\DataFixtures;

use App\Entity\Discipline;
use App\Entity\Rating;
use App\Entity\Student;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RatingFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Rating::class, 100, function (Rating $rating, $count) {
            $rating->setValue($this->faker->numberBetween(0, 20));
            $rating->setStudent($this->getRandomReference(Student::class));
            $rating->setDiscipline($this->getRandomReference(Discipline::class));
        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            StudentFixtures::class,
            DisciplineFixtures::class
        ];
    }
}
