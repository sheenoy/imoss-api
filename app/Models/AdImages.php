<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdImages extends Model
{
    use HasFactory;

    /**
     * Get the comments for the blog post.
     */
    public function ad()
    {
        return $this->belongsTo(Ads::class);
    }
}
