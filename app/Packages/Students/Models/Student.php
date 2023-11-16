<?php

namespace App\Packages\Students\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname', 'lastname', 'email', 'date_of_birth', 'address', 'phone',
    ];
}
