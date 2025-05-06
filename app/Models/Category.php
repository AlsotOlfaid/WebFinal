<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Category;
use App\Models\Response;
use App\Models\Word;

class Category extends Model
{
    public function words(): HasMany
    {
        return $this->hasMany(Word::class);
    }
}
