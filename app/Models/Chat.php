<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function sender() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    
    public function receiver() {
        return $this->belongsTo('App\Models\User', 'receiver_id');
    }
}
