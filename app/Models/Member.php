<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'isVisitor',
        'personGender'
    ];

    public function meetings()
    {
        return $this->belongsToMany(Meeting::class, 'meeting_member');
    }
}
