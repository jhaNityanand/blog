<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'url',
        'category',
        'image',
        'content',
        'tags',
        'status',
        'author',
        'comment',
        'view',
        'meta_title',
        'meta_description',
        'meta_author',
    ];

    public $timestamps = true;

    public function category() {
        return $this->hasOne('App\Models\Category', 'id', 'category');
    }
}
