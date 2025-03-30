<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SubjectTeacher extends Pivot
{

    protected $fillable = [
        'user_id',
        'subject_id',
        'school_classe_id',
    ];

    // Relation avec l'enseignant
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec la matière
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Relation avec la classe
    public function schoolClasse()
    {
        return $this->belongsTo(SchoolClasse::class);
    }
}
