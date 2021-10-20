<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

    protected $table = 'user_profiles';

    // protected $primaryKey = 'pk';

    /*
     * Un perfil pertenece a un usuario
     * */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
