<?php

namespace App\Packages\Students\Services;

use App\Packages\Students\Repositories\StudentsRepositoryInterface;

class StudentsService implements StudentsServiceInterface
{
    public function __construct(private StudentsRepositoryInterface $studentsRepository)
    {
    }

    public function getStudents()
    {
        return $this->studentsRepository->all();
    }
}
