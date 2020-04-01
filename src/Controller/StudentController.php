<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\Rating;
use App\Repository\RatingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/api/student/{id<\d+>}/average", name="student_average")
     */
    public function average(int $id)
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository(Student::class);
        $student = $repository->find($id);

        if (!$student) {
            throw $this->createNotFoundException(
                'No student found for id ' . $id
            );
        }

        $average = $student->getAverage();
        if (is_null($average)) {
            throw $this->createNotFoundException(
                'No rating found for student id ' . $id
            );
        }

        return new JsonResponse(['average' => (string) $average]);
    }

    /**
     * @Route("/api/global/average", name="global_average")
     */
    public function globalAverage()
    {
        $em = $this->getDoctrine()->getManager();

        /** @var RatingRepository $repository */
        $repository = $em->getRepository(Rating::class);
        $ratingAvg = $repository->getRatingAvg();

        if (is_null($ratingAvg['average'])) {
            throw $this->createNotFoundException(
                'No ratings founds'
            );
        }

        return new JsonResponse($ratingAvg);
    }
}
