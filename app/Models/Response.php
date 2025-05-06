<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Word;
use App\Models\Category;
use App\Models\Response;

class Response extends Model
{
    public function word(): BelongsTo
    {
        return $this->belongsTo(Word::class);
    }
}
