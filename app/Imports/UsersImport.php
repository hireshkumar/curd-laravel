<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    
    public function model(array $row)
    {
        $hashedPassword = bcrypt($row['password']);

        $existingStudent = Student::where('email', $row['email'])->first();

    if ($existingStudent) {
        return null; 
    }
        
        return new Student([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => $hashedPassword,
            'number' => $row['number'],
            'gender' => $row['gender'],
            'city' => $row['city'],
            'state_id' => $row['state_id'],
        ]);
    }
}
