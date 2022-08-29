<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;

    protected $fillable = ['status','contact_id','name', 'conversation_id', 'joined_datetime', 'left_datetime'];
    protected $dates = ['joined_datetime', 'left_datetime'];


    public function contact()
    {
        return $this->hasOne(Contact::class);
    }
}
