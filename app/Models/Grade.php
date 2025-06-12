<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
  use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'school_classe_id',
        'user_id',
        'note1',
        'note2',
        'devoir',
        'compos'
    ];

    protected $casts = [
        'note1' => 'decimal:2',
        'note2' => 'decimal:2',
        'devoir' => 'decimal:2',
        'compos' => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function school_Classe()
    {
        return $this->belongsTo(SchoolClasse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Méthode pour calculer la moyenne des notes disponibles
    public function getMoyenneAttribute()
    {
        $notes = collect([$this->note1, $this->note2, $this->devoir, $this->compos])
                    ->filter(function ($note) {
                        return !is_null($note);
                    });

        return $notes->count() > 0 ? round($notes->avg(), 2) : null;
    }
}
