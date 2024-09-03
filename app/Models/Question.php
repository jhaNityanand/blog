<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'title',
        'url',
        'category',
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

    public function categorys() {
        return $this->hasOne('App\Models\Category', 'id', 'category');
    }
}
