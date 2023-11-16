<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use App\Packages\Students\Services\StudentsServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class GetStudentsController extends Controller
{
    public function __construct(private StudentsServiceInterface $studentsService)
    {
    }

    public function __invoke()
    {
        try {

            $students = $this->studentsService->getStudents();

            return response()->json($students, Response::HTTP_OK);
        } catch (Exception $e) {

        }
    }
}
