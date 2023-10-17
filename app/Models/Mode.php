<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mode extends Model
{
    use HasFactory;
    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'game_mode', 'mode_id', 'game_id');
    }
}
