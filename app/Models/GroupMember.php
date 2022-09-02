<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;

    protected $fillable = ['name','contact_id'];
    // protected $dates = ['joined_datetime', 'left_datetime'];

    public $timestamps = false;






    public function contact()
    {
        return $this->hasOne(Contact::class);
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class,'conversations_group_members');

    }
}
