<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tags extends Model
{
    use HasFactory;

    public function Posts(): BelongsToMany
    {
        return $this->belongsToMany(Posts::class, 'link_tags', 'tag_id', 'post_id');
    }
}
