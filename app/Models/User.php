<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'sex',
        'diplome',
        'password',
        'subject_id',
        'school_classe_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

// Relation many-to-many avec Subject via SubjectTeacher
public function subjects()
{
    return $this->belongsToMany(Subject::class, 'subject_teacher', 'user_id', 'subject_id')
                ->using(SubjectTeacher::class)
                ->withPivot('school_classe_id');
}

// Relation many-to-many avec SchoolClasse via SubjectTeacher
public function schoolClasses()
{
    return $this->belongsToMany(SchoolClasse::class, 'subject_teacher', 'user_id', 'school_classe_id')
                ->withPivot('subject_id')
                ->withTimestamps();
}



}
