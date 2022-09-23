<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = [
        'instagram', 'telegram','bio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
