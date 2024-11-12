<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // Al no defenir el campo de Rol aqui nos estamos protiengo de Ataques y no se podra
        // usar para registrarse
        // Si buscamos el archivo RegisteredUserController (SE creo al insalar LAravel Brezze)
        // veremos que por defecto se exponen los campo para evitar que se coloquen columnas como
        // la de Rol, esto de exponer los campos manualmente es porque al usar la funcion de 'Validated()' 
        // por defecto nos expone TODOS los campos y los usuarios asi podrian saber que campos existe
        // en el caso por ejemplo para crear POST no habria problema porque no tenemos campos ocultos pero 
        // en el de usuario si entonces lo menjor es exponerlos manualmente y no con la funcion de validacion 
        // que nos expone todos
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Metodo para el Middleware para verificar si el usuario es Admin o No
    // Esta logica se pone en la logica de Negocio
    public function isAdmin() : bool
    {
        return $this->rol == 'admin';
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
