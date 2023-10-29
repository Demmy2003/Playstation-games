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
    protected $fillable = ['title', 'description', 'rating', 'image', 'user_id', 'total_likes', 'total_dislikes'];

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
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
    public function dislikes(): HasMany
    {
        return $this->hasMany(Dislike::class);
    }
    public function calculateTotalLikesAndDislikes()
    {
        $likes = $this->likes()->count();
        $dislikes = $this->dislikes()->count();

        // Calculate the rating as a percentage of likes relative to total votes
        $rating = ($likes / max(($likes + $dislikes), 1)) * 10;

        // Ensure the rating does not go higher than 10
        $rating = min($rating, 10);

        $this->rating = $rating;
        $this->total_likes = $likes;
        $this->total_dislikes = $dislikes;
        $this->save();
    }


}
