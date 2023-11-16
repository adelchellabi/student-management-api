<?php

namespace App\Packages\Students\Repositories\Eloquent;

use App\Packages\Students\Models\Student;
use App\Packages\Students\Repositories\StudentsRepositoryInterface;

class StudentsRepository extends Repository implements StudentsRepositoryInterface
{
    public function __construct(Student $model)
    {
        parent::__construct($model);
    }
}
