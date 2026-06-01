<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function image()
    {
         return $this->morphOne(Image::class, 'imageable');
    }
}
