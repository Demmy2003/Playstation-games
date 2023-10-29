<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Game extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'rating', 'image', 'user_id'];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'game_genre', 'game_id', 'genre_id');
    }

    public function modes(): BelongsToMany
    {
        return $this->belongsToMany(Mode::class, 'game_mode', 'game_id', 'mode_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
    public function calculateTotalRating()
    {
        $likes = $this->ratings()->where('type', 'like')->count();
        $dislikes = $this->ratings()->where('type', 'dislike')->count();
        if ($dislikes === 0) {
            $totalRating = 100; // Handle division by zero
        } else {
            $totalRating = ($likes / $dislikes) * 10;
        }

        $this->rating = $totalRating;
        $this->save();
    }
}
