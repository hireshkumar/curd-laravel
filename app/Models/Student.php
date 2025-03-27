<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    use HasFactory;
    protected $table = 'studentdata';
    protected $fillable = [
        'name','email','password','number','gender','city','state_id','profile_photo'
    ];
}