<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['first_name', 'last_name', 'school_classe_id'];

    public function school_classe()
    {
        return $this->belongsTo(SchoolClasse::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
