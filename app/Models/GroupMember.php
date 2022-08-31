<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;

    protected $fillable = ['contact_id','name', 'conversation_id'];
    // protected $dates = ['joined_datetime', 'left_datetime'];

    public $timestamps = false;

    public function contact()
    {
        return $this->hasOne(Contact::class);
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
