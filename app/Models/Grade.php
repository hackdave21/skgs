<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['student_id', 'subject_id', 'school_classe_id', 'user_id', 'note'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function school_classe()
    {
        return $this->belongsTo(SchoolClasse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
