<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    /**
     * Get the comments for the blog post.
     */
    public function photos()
    {
        return $this->hasMany(AdImages::class, 'ad_id');
    }
}
