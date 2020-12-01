<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function images()
    {
        return $this->belongsToMany(Image::class, ImageArticle::class);
    }
}
