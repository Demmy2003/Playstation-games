<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'rating', 'image'];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'game_genre', 'game_id', 'genre_id');
    }

    public function modes(): BelongsToMany
    {
        return $this->belongsToMany(Mode::class, 'game_mode', 'game_id', 'mode_id');
    }
}
