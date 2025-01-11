<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClasse extends Model
{
    protected $fillable = ['name'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
