<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'body',
        'author'
    ];

    public function category() :BelongsTo
    {
        return $this->BelongsTo(Category::class, 'category_id');
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
    }
}
