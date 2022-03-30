<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentIntention extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'user_id',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function visitor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
