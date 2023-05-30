<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'comment'
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'foreign_key', 'local_key');
    }
}
