<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    /*
     * Un post pertenece a un usuario (autor)
     * */
    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
