<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /*
      * Una categoria pertence o tiene muchos post y vicevrsa
      * */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post');
    }
}
