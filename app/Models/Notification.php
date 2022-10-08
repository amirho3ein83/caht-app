<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'user_id', 'read_at'];
    protected $dates = ['read_at'];
    // protected $appends = ['created_at'];


    // protected function createdAt(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => $value->diffForHumans(),
    //     );
    // }
}
