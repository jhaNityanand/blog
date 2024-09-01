<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'content_image';

    protected $fillable = [
        'image_name',
        'image_url',
        'status',
    ];

    public $timestamps = true;
}
