<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_name',
        'meeting_date',
        'description',
    ];

    public function members()
    {   
        return $this->belongsToMany(Member::class, 'meeting_member', 'meeting_id', 'member_id');
    }
}
