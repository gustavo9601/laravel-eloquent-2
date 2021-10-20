<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'title', 'content'
    ];

    /*
     * Un post pertenece a un usuario (autor)
     * */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /*
     * Un post tiene o pertenece a muchas categorias y viceversa
     *
     * $category = Category::create(['title'=>'safari']);
     * // Pushea
     * Post::first()->categories()->attach($category);
     * // Vacia la relacion y pushea
     * Post::first()->categories()->sync($category);
     * // Evita que se duplica los indices y pushea solo si es diferente
     * Post::first()->categories()->syncWithoutDetaching($category);
     * Post::first()->categories()->syncWithoutDetaching([$category->id,$category2->id ]);
     * */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }

    /*
     * $category // Instancia del meodelo eloquent
     * Post::first()->addCategories($category1, $category2)
     * */
    public function addCategories(Category ...$categories)
    {
        $this->categories()->sync(new Collection($categories));
    }
}
