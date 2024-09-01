<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'created_by',
        'reply',
        'name',
        'email',
        'message',
        'type',
        'ip_address',
        'blog_id',
        'status',
    ];

    public $timestamps = true;
}
