<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Usualmente una tabla esta sociada a la migracion y al final la tabla esta sociada a un modelo
    // Para la mayoria de los casos las columnas de la tabla que creamos en la migracion equivale a un
    // campo del modelo
    use HasFactory;

    // Por cuestiones de seguridad hay que configurar cuales columnas queremos exponer
    // En este caso queremos exponer Todos (Estos son los campos con los que vamos a trabajar)
    protected $fillable = ['title','slug', 'content', 'category_id', 'description','posted','image'];

    // Aqui es donde creamos la relaciones hasMany() o belongTo()
    // Esta relacion es una funcion ya que para obtener los datos del objeto no se encuentran especificado en la base de datos
    // y solo esta en la asignacion de la llave foranea que donde ambos coinciden (En las dos tablas relacionadas)
    // Pero aqui queremos hacer una relacion para obtener el objeto mediante otra relacion

    // La funcion puede tener cualquier nombre pero por convencion se coloca el de la otra Tabla
    public function category() {
        // Retornamos el tipo de relacion a soportar (Que nos son mediante los atributos sino por funciones)
        // Estas funciones se pueden usar para hacer cateos o regresar una estructura o establecer valores
        // Como la Categoria es la que tiene muchos POST entonces es HasMany pero aqui indicamos la que el POST tiene una cateogira
        // tampoco es la de tipo ONE porque esa es de la relacion directa (ManytoMany, HasMany, One, HasOne), en este caso es una relacion inversa
        // Asi que lo tenemos que indicar viendolo al Revez (Una categoria Pertenece a un POST) que es de tipo BELONGS

        // Le pasamos el modelo de la otra tabla 
        // Es importante saber la convencion de nombres en LAravel porque gracias a que seguimos llamandolo en ingles sabe que campo buscar que es "category_id" 
        // En caso que no lo reconosca laravel tenemos que hacer la relacion de manera manual tenemos que pasarle como otro parametro el nombre del campo
        return $this->belongsTo(Category::class);//(Category::class, 'NombreDelCampo')
    }
}
