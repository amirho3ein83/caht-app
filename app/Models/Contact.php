<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [ 'username','is_online','last_active_at'];

    public $dates = ['last_active_at'];
    public $timestamps = false;


    protected $appends = [
        'profile',
    ];

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class,'conversations_contacts');

    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getProfileAttribute()
    {
        // return url("storage/profile-photos/{$this->profile}");
        return url("storage/profile-photos/amirshafi.png");
    }
}
