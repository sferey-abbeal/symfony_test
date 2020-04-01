<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Common\Persistence\ObjectManager;

class StudentFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Student::class, 30, function (Student $student, $count) {
            $student->setFirstName($this->faker->firstName);
            $student->setLastName($this->faker->lastName);
            $student->setBirthDate($this->faker->dateTimeThisCentury);
        });

        $manager->flush();
    }
}
