<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['student_id', 'school_classe_id', 'academic_year_id', 'report_path'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function school_classe()
    {
        return $this->belongsTo(SchoolClasse::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
