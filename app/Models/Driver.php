<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Driver extends Model
{
    protected $guarded = [];

    public function responses(): BelongsToMany
    {
        return $this->belongsToMany(Response::class);
    }
}
