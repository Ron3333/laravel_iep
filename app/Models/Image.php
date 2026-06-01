<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['url'])]
class Image extends Model
{
    public function imageable()
    {
        return $this->morphTo();
    }

}
