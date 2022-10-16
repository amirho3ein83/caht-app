<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutedChat extends Model
{
    use HasFactory;

    protected $fillable = ['chat_id', 'for'];
    protected $table = 'muted_chats';
    public $timestamps = false;

}
