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
    return $this->belongsToMany(User::class, 'subject_teacher', 'school_classe_id', 'user_id')
                ->withPivot('subject_id')
                ->withTimestamps();
}

    public function subjects()
{
    return $this->hasMany(Subject::class, 'school_class_id');
}
}
