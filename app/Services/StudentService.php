<?php

namespace App\Services;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use Illuminate\Support\Arr;

class StudentService 
{
    public function createStudent(array $data): Student 
    {
        $student = Student::create(Arr::except($data, ['address']));

        if(isset($data['address'])) {
            $student->address->create($data['address']);
        }

        $student->load('address');

        return $student;
    }

    public function updateStudent(array $data, Student $student): Student
    {   
        $student->update(Arr::except($data, ['address']));

        if(isset($data['address'])) {
            $student->address()->updateOrCreate(
                ['student_id' => $student->id],
                $data['address']
            ); 
        }

        return $student->load('address');
    }
}