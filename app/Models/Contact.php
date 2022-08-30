<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name','email'];

    protected $appends = [
        'profile',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function getProfileAttribute()
    {
        return url('storage/profile-photos/ss.jpg');
    }
}
