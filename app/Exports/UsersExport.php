<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Student::select(
                'studentdata.id', 
                'studentdata.name', 
                'studentdata.email', 
                'studentdata.number', 
                'studentdata.gender', 
                'cities.name as city', 
                'states.name as state'
            )
            ->join('states', 'states.id', '=', 'studentdata.state_id')
            ->join('cities', 'cities.id', '=', 'studentdata.city')
            ->orderBy('studentdata.id', 'DESC')
            ->get();
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Email', 'Number', 'Gender', 'City', 'State'];
    }
}
