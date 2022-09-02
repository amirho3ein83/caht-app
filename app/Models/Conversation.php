<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['name','last_message'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function groupMembers()
    {
        return $this->belongsToMany(GroupMember::class,'conversations_group_members');
    }
}
