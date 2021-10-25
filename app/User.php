<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'options', 'apí_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'options' => 'array',  // accessor a array
    ];


    /*
     * Un usuario tiene un perfil
     * */
    public function profile()
    {


        return $this->hasOne(UserProfile::class);


        /*
         * withDefault // devuelve un objeto y adiciona los valores por default, de no exisitir la relacion
         * return $this->hasOne(UserProfile::class)->withDefault([
            'website' => 'url'
        ]);*/
    }

    /*
     * Un usuario (author) tiene muchos posts
     * */
    public function posts()
    {
        // return $this->hasMany(Post::class);
        // Especificando la llave foranea en la tabla posts
        return $this->hasMany(Post::class, 'author_id');
    }


    public function publishedPosts()
    {
        return $this->posts()->where('published_at', '<=', now());
    }

    /*
     * Mutators
     * */

    // set<<Name Attribute>>Attribute
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }


    public function setOptionsAttribute(array $value)
    {
        $this->attributes['options'] = json_encode($value);
    }


    /*
     * Accessors
     * */
    // get<<Name Attribute>>Attribute
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    // atributo virtual
    // $user->full_name
    public function getFullNameAttribute()
    {
        return $this->name . ' AAAAA';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

}
