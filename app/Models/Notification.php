<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'user_id', 'read_at','writer'];
    protected $dates = ['read_at'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->diffForHumans();
    }

}
