<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Esta propiedad se pone si no tenemos la columna de Timestamps en la tabla de migracion
    // Asi hacemos que laravel no busque esa columna para poder registrar un registro
    //public $timestamps = false;

    protected $fillable = ['title','slug'];

    // Si queremos implementarle la relacion a la categoria seria de forma inversa
    // lo llamamos 'posts' en plural porque una categoria puede estar asignada a multiples POSTS
    function posts(){
        // Es de tipo HasMany porque podemos tener varios posts
        return $this->hasMany(Post::class);
    }
}
