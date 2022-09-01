<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['from', 'text', 'conversation_id','contact_id','to'];
    protected $dates = ['sent_datetime'];

    public $timestamps = false;

    protected function sentDatetime(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('H:i')
        );
    }
}
