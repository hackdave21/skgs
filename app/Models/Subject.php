<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name'];

    public function users()
{
    return $this->belongsToMany(User::class, 'subject_teacher')
                ->using(SubjectTeacher::class)
                ->withPivot('school_classe_id')
                ->withTimestamps();
}

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

}
