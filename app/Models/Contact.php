<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [ 'username','is_online'];

    public $timestamps = false;


    protected $appends = [
        'profile',
    ];

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class,'conversations_contacts');

    }

    public function getProfileAttribute()
    {
        return url('storage/profile-photos/ss.jpg');
    }
}
