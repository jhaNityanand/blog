<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile';

    protected $fillable = [
        'user_id',
        'url',
        'image',
        'message',
        'status',
        'facebook',
        'instagram',
        'linkdin',
        'twitter',
        'youtube',
        'gmail',
        'telegram',
    ];

    public $timestamps = true;
}
