<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'title', 'content', 'featured', 'published_at'
    ];


    protected $casts = [
        'featured' => 'bool',
        'published_at' => 'datetime:d/m/Y H:i',
    ];

    //Especifica unicamente los campos a mostrar
    protected $visible = [
        'title', 'content', 'published_at', 'author', 'categories',
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
        // withPivot(['featured']) // permite especificar que campos se quieren añadir a la vista de la tabla pivote
        // withTimesTamps // permite que tenga encuentra los campos de creacion y atualizacion
        return $this->belongsToMany(Category::class, 'category_post')
            ->withPivot(['featured'])
            ->withTimestamps();
    }

    /*
     * $category // Instancia del meodelo eloquent
     * Post::first()->addCategories($category1, $category2)
     * */
    public function addCategories(Category ...$categories)
    {
        // syncWithoutDetaching // añade los regustros nuevos pero no elimina los existentes
        $this->categories()->syncWithoutDetaching(new Collection($categories));
    }
}
