<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Esto se pone en verdadero para que acepte la peticion
        // Esto es para cuando tengamos usuarios y Roles y saber si tienen acceso a cierta accion
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Aqui van las reglas de validacion
            // Tiene que ser el mismo nombre en el modelo, tabla, HTML
            'title' => 'required|min:5|max:500', // La longitud maxima la ponemos igual que lo maximo en la tabla de la BD
            // El SLUG debe de tener un valor unico que mas adelante vamos a crear a partir del titulo (Debe ser un identificador unico)
            // ya que es la forma en la que vamos a acceder al recurso (Ya que si tenemos muchos posts (articulos) y en algun momento se 
            // registre un mismo titulo entonces lo que pasaria es que se sobrescriben al querer acceder al articulo)
            // Para esto colocamos una regla adicional: Unique:Tabla (La tabla donde hace Match en el campo llamado SLUG)
            'slug' => 'required|min:5|max:500|unique:posts',// Al usar el mismo nombre en todo Larael ya junta el modelo, controlador, tabla
            'content' => 'required|min:7',
            'category_id' => 'required|integer',
            'description' => 'required|min:7',
            'posted' => 'required',
            
        ];
    }
}
