<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blocked extends Model
{
    use HasFactory;

    protected $table = 'blocked';
    
    protected $fillable = ['created_by','blocked_user'];

    protected $timestampts = false;
}
