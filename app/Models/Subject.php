<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
    public function subjects()
{
    return $this->belongsToMany(Subject::class)->withPivot('note');
}
}
