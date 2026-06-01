<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Post extends Model
{
    use HasFactory; 
    protected $fillable = ['title', 
                            'slug', 
                            'content', 
                            'item',
                            'category_id', 
                            'description', 
                            'posted', 
                            'image'];

   

     public function category()
    {
         return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}
